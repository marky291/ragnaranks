<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListingRanking.
 *
 * @property int id
 * @property int rank
 * @property int votes
 * @property int clicks
 * @property int points
 * @property Listing $listing
 * @method static Builder where(string $string, int $param)
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Add a vote and populate its points on a table.
     *
     * @param Listing $listing
     */
    public static function incrementVote(Listing $listing): void
    {
        self::query()->where('listing_id', $listing->getKey())->update([
            'votes' => DB::raw('votes + 1'),
            'points' => DB::raw('points + '.config('action.vote.value')),
        ]);
    }

    /**
     * Add a click and populate its points on the table.
     *
     * @param Listing $listing
     */
    public static function incrementClick(Listing $listing)
    {
        self::query()->where('listing_id', $listing->getKey())->update([
            'clicks' => DB::raw('clicks + 1'),
            'points' => DB::raw('points + '.config('action.click.value')),
        ]);
    }
}
