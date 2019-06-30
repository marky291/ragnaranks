<?php

namespace App\Observers;

use App\Interactions\Review;

/**
 * Class ReviewObserver
 *
 * @package App\Observers
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
}
