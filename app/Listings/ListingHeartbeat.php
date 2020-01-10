<?php

namespace App\Listings;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListingHeartbeat
 *
 * @property int $listing_id
 * @property string $recorder
 * @property string $login
 * @property string $char
 * @property string $map
 * @property integer $players
 * @property integer $success_count
 * @property integer $failure_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
        'recorder', 'login', 'char', 'map', 'players',
    ];

    /**
     * Determine if this heartbeat has a recorder
     *
     * @return bool
     */
    public function hasRecorder()
    {
        return $this->recorder !== 'none';
    }
}
