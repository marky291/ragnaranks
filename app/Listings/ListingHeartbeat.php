<?php

namespace App\Listings;

use App\Heartbeats\Informer;
use App\Heartbeats\InformerResults;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class ListingHeartbeat
 *
 * @property int $listing_id
 * @property string $informer
 * @property string $login
 * @property string $char
 * @property string $map
 * @property integer $players
 * @property integer $success_count
 * @property integer $failure_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method ListingHeartbeat|Builder createdSinceYesterday()
 * @method ListingHeartbeat|Builder fromStartOfDay()
 * @method ListingHeartbeat|Builder groupPlayersHourly()
 *
 * @package App\Listings
 */
class ListingHeartbeat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'informer', 'login', 'char', 'map', 'players',
    ];

    /**
     * Save results generated from an informer.
     *
     * @param InformerResults $informer
     * @return ListingHeartbeat
     */
    public function fillInformerResults(InformerResults $informer): ListingHeartbeat
    {
        return $this->fill([
            'informer' => $informer->getInformerName(),
            'login' => $informer->getLoginStatus(),
            'char' => $informer->getCharStatus(),
            'map' => $informer->getMapStatus(),
            'players' => $informer->getPlayerCount(),
        ]);
    }

    /**
     * Return the status as a string.
     *
     * @param bool $status
     * @return string
     */
    public function toStatusName(bool $status): string
    {
        return $status ? 'online' : 'offline';
    }

    /**
     * API GRAPHS
     *
     * @param Builder $builder
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeCreatedSinceYesterday(Builder $builder)
    {
        return $builder->whereRaw("created_at >= DATE_SUB(CURDATE(), INTERVAL 47 HOUR)");
    }

    public function scopeFromStartOfDay(Builder $builder)
    {
        return $builder->whereRaw('created_at >= CURDATE()');
    }

    public function scopeGroupPlayersHourly(Builder $builder)
    {
        return $builder->selectRaw('HOUR(created_at) as hour, CEIL(AVG(players)) as players')->groupBy('hour');
    }
}
