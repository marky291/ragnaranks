<?php

namespace App\Listings;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function view(?User $user, Listing $listing)
    {
        return true;
    }

    /**
     * Determine whether the user can create listings.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function create(User $user, Listing $listing)
    {
        return true;
    }

    /**
     * Can the user analyze the resource.
     *
     * @param User|null $user
     * @param Listing $listing
     * @return bool
     */
    public function analyze(User $user, Listing $listing): bool
    {
        return $listing->user_id == $user->id;
    }

    /**
     * Determine whether the user can update the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function update(?User $user, Listing $listing)
    {
        return $user->id == $listing->user_id;
    }

    /**
     * Determine whether the user can delete the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function delete(User $user, Listing $listing)
    {
        return $user->id == $listing->user_id;
    }

    /**
     * Determine whether the user can review the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function review(User $user, Listing $listing): bool
    {
        return $listing->reviews()->where('user_id', $user->id)->doesntExist();
    }

    /**
     * Determine whether the user can restore the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function restore(User $user, Listing $listing)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function forceDelete(User $user, Listing $listing)
    {
        //
    }
}
