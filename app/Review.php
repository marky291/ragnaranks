<?php

namespace App;

use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @property int $id
 * @property string $message
 * @property int $donation_score
 * @property int $update_score
 * @property int $class_score
 * @property int $item_score
 * @property int $support_score
 * @property int $hosting_score
 * @property int $content_score
 * @property int $event_score
 * @property Listing $listing
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property double average_score
 *
 * @method static Collection latest()
 *
 * @package App
 */
class Review extends Model
{
    /**
     * A review belongs to a single listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Scope the query in order of latest.
     *
     * @param Builder $query
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeLatest(Builder $query)
    {
        return $query->orderByDesc('created_at');
    }

    /**
     * Get the average score of the review.
     *
     * @return float
     */
    public function getAverageScoreAttribute()
    {
        $scores = [
            $this->content_score,
            $this->hosting_score,
            $this->support_score,
            $this->event_score,
            $this->item_score,
            $this->class_score,
            $this->update_score,
            $this->donation_score,
        ];

        return round(array_sum($scores) / count($scores), 1);
    }
}
