<?php

namespace App\Listings;

use App\Click;
use App\Mode;
use App\Tag;
use App\User;
use App\Vote;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Listings
 *
 * @property int $rank
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $website
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 * @property array $configs
 *
 * @property string $exp_group
 *
 * @property Mode $mode
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property Vote|HasMany $votes
 * @property Click|HasMany $clicks
 *
 * @method static withCount(string $string)
 * @method static expGround(int $period, string $group)
 *
 * @method static Collection HighestVoteTrend()
 * @method static Collection HighestClickTrend()
 * @method static Collection LatestReviews()
 *
 *
 * @package App
 */
class Listing extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'configs' => 'array',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * A server has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(Mode::class, 'id', 'mode_id');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     */
    public function votes()
    {
        return $this->morphedByMany('App\Vote', 'interaction');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     *
     */
    public function clicks()
    {
        return $this->morphedByMany('App\Click', 'interaction');
    }

    /**
     * A server belongs to a single owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The tags that belong to this server.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to descend order of having latest review.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestReviews($query)
    {
        return $query;

    }

    /**
     * Get the EXP group that the server belongs to.
     *
     * @return string
     * @throws \Exception
     * @noinspection PhpUnhandledExceptionInspection
     *
     * @todo: Move this to ListingConfig::class ?
     */
    public function getExpGroupAttribute()
    {
        $server_base = $this->configs[base_exp_rate];

        if ($server_base <= config('filter.exp.low-rate.max'))
            return 'Low Rate';
        if ($server_base <= config('filter.exp.mid-rate.max'))
            return 'Mid Rate';
        if ($server_base <= config('filter.exp.high-rate.max'))
            return 'High Rate';

        throw new \Exception("Bad configuration for exp group Attribute");
    }

    /**
     * Exp group = The group of servers to work with [low-rate, mid-rate, high-rate]
     * Mode      = The server mode that we work with [renewal, classic, custom, pre-renewal]
     *
     * @param string $exp_group The group type [low-rate, mid-rate, high-rate]
     * @param string $mode The server mode [renewal, classic, custom, pre-renewal]
     * @param string $sort_column The column that should be sorted. [columns]
     * @param string $orderBy The order in which the result should be returned [desc, asc]
     *
     * @throws Exception
     *
     * @return Builder
     *
     * @todo: Make its own class? [FilterBuilder]
     */
    public static function filter($exp_group = "all", $mode = "all", $sort_column = "any", $orderBy = 'desc')
    {
        $builder = self::query();

        if (in_array($mode, ['renewal', 'pre-renewal', 'classic', 'custom'])) {
            $builder->whereHas('mode', function(Builder $query) use ($mode) {
                $query->where('name', $mode);
            });
        }
        if (in_array($exp_group, ['low-rate', 'mid-rate', 'high-rate', 'custom', 'classic'])) {
            $builder->whereHas('config', function($query) use ($exp_group) {
                /** @var ListingConfig $query */
                $query->expGroup($exp_group);
            });
        }
        if (in_array($sort_column, ['rank', 'episode', 'created_at'])) {
            $builder->orderBy($sort_column, $orderBy);

            // secondary ordering of orders. [kayru parameters]
            if ($sort_column != 'rank') {
                $builder->orderBy('rank', 'asc');
            }
        }


        // TODO: Add checks for sort column and order by?

        return $builder;
    }
}
