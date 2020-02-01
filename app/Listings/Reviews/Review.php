<?php

namespace App\Listings\Reviews;

use App\Listings\HasPerformingAction;
use App\Listings\Interaction;
use App\User;
use Carbon\Carbon;
use App\ReviewComment;
use App\Listings\Listing;
use Illuminate\Database\Eloquent\Builder;
use Artisanry\Reportable\Traits\HasReports;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @method static Builder latest()
 * @property Listing listing
 * @method static Review|Builder publishedBy($publisher)
 * @method static Review|Builder forListing($listing)
 * @method static first()
 * @property int $average_score
 * @property-read User $user
 * @property int totalScore
 * @property int percentScore
 * @property int user_id
 */
class Review extends Interaction
{
    /*
     * @link https://github.com/artisanry/reportable/blob/master/src/Traits/HasReports.php
     */
    use HasReports, HasPerformingAction;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'message' => '',
        'donation_score' => 0,
        'update_score' => 0,
        'class_score' => 0,
        'item_score' => 0,
        'support_score' => 0,
        'hosting_score' => 0,
        'content_score' => 0,
        'event_score' => 0,
    ];

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
     * @param Builder $query
     * @param Listing $listing
     * @return Builder
     */
    public function scopeForListing(Builder $query, Listing $listing): Builder
    {
        return $query->where('listing_id', $listing->id);
    }

    /**
     * Get a total count of all the stars giving.
     *
     * @return float|int
     */
    public function getTotalScoreAttribute()
    {
        return array_sum([$this->donation_score, $this->update_score, $this->class_score, $this->item_score, $this->support_score, $this->hosting_score, $this->content_score, $this->event_score]);
    }

    /**
     * Get a percentage based score.
     *
     * @return float
     */
    public function getPercentScoreAttribute(): float
    {
        return ceil($this->totalScore * 2.5);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     *
     * @return Collection
     */
    public function newCollection(array $models = [])
    {
        return new ReviewCollection($models);
    }
}
