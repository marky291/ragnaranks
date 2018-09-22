<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Server
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 *
 * @property ServerConfig $config
 * @property ServerMode $mode
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property ServerVote|HasMany $votes
 * @property ServerClick|HasMany $clicks
 *
 * @method static withCount(string $string)
 * @method static statistics(int $period)
 *
 *
 * @package App
 */
class Server extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers';

    /**
     * A server has one configuration set.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function config()
    {
        return $this->hasOne(ServerConfig::class, 'server_id', 'id');
    }

    /**
     * A server has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(ServerMode::class, 'id', 'mode_id');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clicks()
    {
        return $this->hasMany(ServerClick::class, 'server_id', 'id');
    }

    /**
     * A server can have many votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(ServerVote::class,'server_id', 'id');
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
     * Scope a query to only include popular users.
     *
     * @param int $period
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatistics($query, int $period)
    {
        return $query->withCount([
            'votes' => function($query) use ($period){ $query->where('created_at', '>', now()->subDay($period)); },
            'clicks' => function($query) use ($period){ $query->where('created_at', '>', now()->subDay($period)); },
        ]);
    }

    /**
     * Order the servers by their count of votes.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filterVotes(int $period = 30)
    {
        return self::statistics($period)->orderBy('votes_count', 'desc');
    }

    /**
     * Order the servers by their count of votes.
     *
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filterClicks(int $period = 30)
    {
        return self::statistics($period)->orderBy('clicks_count', 'desc');
    }

    /**
     * Return the servers in an order, by their creation date.
     *
     * @param string $orderBy
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function orderedCreation(string $orderBy)
    {
        return self::query()->orderBy('created_at', $orderBy);
    }

}
