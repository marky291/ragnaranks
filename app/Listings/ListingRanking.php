<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class ListingRanking
 *
 * @property int id
 * @property int rank
 * @property int votes
 * @property int clicks
 * @property int points
 *
 * @package App\Listings
 */
class ListingRanking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rank', 'votes', 'points', 'clicks'];

    /**
     * The model's default attributes.
     *
     * @var array
     */
    protected $attributes = ['votes' => 0, 'clicks' => 0, 'points' => 0];

    /**
     * We dont use a creation table only updated.
     *
     * @var string
     */
    public const CREATED_AT = null;

    /**
     * Add a vote and populate its points on a table
     *
     * @param Listing $listing
     */
    public static function incrementVote(Listing $listing): void
    {
        self::query()->where('listing_id', $listing->getKey())->update([
            'votes' => DB::raw('votes + 1'),
            'points' => DB::raw('points + '.config('action.vote.value'))
        ]);
    }

    /**
     * Add a click and populate its points on the table
     *
     * @param Listing $listing
     */
    public static function incrementClick(Listing $listing)
    {
        self::query()->where('listing_id', $listing->getKey())->update([
            'clicks' => DB::raw('clicks + 1'),
            'points' => DB::raw('points + '.config('action.click.value'))
        ]);
    }
}
