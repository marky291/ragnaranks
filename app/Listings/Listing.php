<?php

namespace App\Listings;

use App\Click;
use App\Mode;
use App\Review;
use App\Tag;
use App\User;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

/**
 * Class Listings
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $points
 * @property string $website
 * @property double $rating
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 * @property array $configs
 * @property Mode $mode
 * @property string $expRateTitle
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Collection $tags
 * @property Collection|HasMany $reviews
 * @property Vote|HasMany $votes
 * @property Click|HasMany $clicks
 * @property int $rank
 * @property int votes_count
 * @property int clicks_count
 * @package App
 * @property int $user_id
 * @property int $mode_id
 * @property-read string $exp_rate_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereBannerUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereConfigs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings\Listing whereWebsite($value)
 * @mixin \Eloquent
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
        'statistics' => 'array',
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
     * Generate a default slug for the column.
     *
     * @return string
     */
    public function generateDefaultSlug()
    {
        return $this->slug = str_slug($this->name);
    }

    /**
     * A listing has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(Mode::class, 'id', 'mode_id');
    }

    /**
     * A listing can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     */
    public function votes()
    {
        return $this->morphedByMany('App\Vote', 'interaction');
    }

    /**
     * A listing can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     *
     */
    public function clicks()
    {
        return $this->morphedByMany('App\Click', 'interaction');
    }

    /**
     * A listing belongs to a single owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to this listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * A listing has many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ListingFilter($models);
    }

    /**
     * Get the rating of this listing, based on average review scores.
     *
     * @return mixed
     */
    public function getRatingAttribute()
    {
        return $this->reviews()->selectRaw("round((sum(content_score+hosting_score+support_score+event_score+item_score+class_score+update_score+donation_score) / (count(donation_score) * 8) / 2), 1) as rating")->first()->rating;
    }

    /**
     * Get the total points of the listing.
     *
     * Used for ranking servers against others.
     *
     * @return float|int
     */
    public function getPointsAttribute()
    {
        return round($this->votes->count() + ($this->clicks->count() / 7), 0);
    }

    /**
     * Get the EXP group that the listing belongs to.
     *
     * @return string
     */
    public function getExpRateTitleAttribute()
    {
        $server_base = $this->configs['base_exp_rate'];

        if ($server_base <= config('filter.exp.low-rate.max'))
            return 'Low Rate';
        if ($server_base <= config('filter.exp.mid-rate.max'))
            return 'Mid Rate';
        if ($server_base <= config('filter.exp.high-rate.max'))
            return 'High Rate';

        return "Super High Rate";
    }
}
