<?php

namespace App\Interactions;

use App\User;
use Carbon\Carbon;
use App\ReviewComment;
use App\Listings\Listing;
use Illuminate\Database\Eloquent\Builder;
use BrianFaust\Reportable\Traits\HasReports;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Review.
 *
 * @property int $id
 * @property string $message
 * @property string $ip_address
 * @property int $donation_score
 * @property int $update_score
 * @property int $class_score
 * @property int $item_score
 * @property int $support_score
 * @property int $hosting_score
 * @property int $content_score
 * @property int $event_score
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @method static Collection latest()
 * @property Listing listing
 * @method static Collection publishedBy($publisher)
 * @property-read float $average_score
 * @property-read User $user
 * @mixin \Eloquent
 */
class Review extends Interaction
{
    /*
     * @link https://github.com/artisanry/reportable/blob/master/src/Traits/HasReports.php
     */
    use HasReports;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * A review has many comments.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ReviewComment::class);
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
     * Scope the query based on publisher.
     *
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopePublishedBy(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
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
