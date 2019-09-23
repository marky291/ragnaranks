<?php

namespace App\Reviews;

use App\Listings\Listing;
use App\User;
use App\Interactions\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reviews.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the review.
     *
     * @param User $user
     * @param Review $review
     * @return mixed
     */
    public function view(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param User $user
     * @param Review $review
     * @param Listing $listing
     * @return mixed
     */
    public function create(User $user, Review $review, Listing $listing)
    {
        return $listing->reviews()->where('user_id', auth()->id())->count() == false;
    }

    /**
     * Determine whether the user can update the review.
     *
     * @param User $user
     * @param Review $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return $user->id == $review->user_id;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param User $user
     * @param Review $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        return $user->id == $review->user_id;
    }

    /**
     * Determine whether the user can restore the review.
     *
     * @param User $user
     * @param Review $review
     * @return mixed
     */
    public function restore(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the review.
     *
     * @param User $user
     * @param Review $review
     * @return mixed
     */
    public function forceDelete(User $user, Review $review)
    {
        //
    }
}
