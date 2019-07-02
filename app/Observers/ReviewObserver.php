<?php

namespace App\Observers;

use App\Interactions\Review;
use App\Jobs\UpdateListingReviewScoreAverage;

/**
 * Class ReviewObserver.
 */
class ReviewObserver
{
    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Review $review
     * @return void
     */
    public function creating(Review $review): void
    {
        $scores = [
            $review->content_score,
            $review->hosting_score,
            $review->support_score,
            $review->event_score,
            $review->item_score,
            $review->class_score,
            $review->update_score,
            $review->donation_score,
        ];

        $review->average_score = round(array_sum($scores) / count($scores), 1);
    }

    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Review $review
     * @return void
     */
    public function created(Review $review): void
    {
        dispatch(new UpdateListingReviewScoreAverage($review->listing));
    }
}
