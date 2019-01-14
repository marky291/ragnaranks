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
 * @method static Collection latest()
 * @method static Collection publishedBy($publisher)
 * @package App
 * @property int $listing_id
 * @property-read float $average_score
 * @property-read \App\User $publisher
 * @mixin \Eloquent
 */
class Review extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function(Model $model) {
            if (is_null($model->getAttribute('publisher_id'))) {
                $model->setAttribute('publisher_id', auth()->user()->getAuthIdentifier());
            }
        });
    }


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
     * A review has a single publisher user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(User::class);
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

    public function scopePublishedBy(Builder $query, User $publisher)
    {
        return $query->where('publisher_id', $publisher->id);
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
