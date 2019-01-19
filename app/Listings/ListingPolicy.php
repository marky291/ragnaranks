<?php

namespace App\Listings;

use App\Interactions\Click;
use App\Interactions\Vote;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can review the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function review(User $user, Listing $listing)
    {
        return $listing->reviews()->publishedBy($user)->count() == false;
    }

    /**
     * Determine whether the user can vote on the listing.
     *
     * @param User $user
     * @return mixed
     */
    public function vote(?User $user)
    {
        return Vote::hasInteractedWith(6);
    }

    /**
     * Determine whether the user can click on the listing.
     *
     * @param User $user
     * @return mixed
     */
    public function click(?User $user)
    {
        return Click::hasInteractedWith(1);
    }
}
