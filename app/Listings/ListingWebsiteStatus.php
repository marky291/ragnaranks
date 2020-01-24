<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListingWebsiteStatus
 *
 * @package App
 */
class ListingWebsiteStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'listing_website_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website', 'status', 'reason'
    ];

    /**
     * Scope a query to with all of its relations eager loaded.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeOffline(Builder $builder): Builder
    {
        return $builder->where('status', '!=', 200);
    }

    /**
     * Limit the query to the hours.
     *
     * @param Builder $builder
     * @param int $hoursToSubtract
     * @return Builder
     */
    public function scopeHours(Builder $builder, int $hoursToSubtract) : Builder
    {
        return $builder->whereTime('created_at', '>', now()->subHours($hoursToSubtract)->toTimeString());
    }
}
