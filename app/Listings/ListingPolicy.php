<?php

namespace App\Listings\Policies;

use App\User;
use App\Listings\Listing;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability): ?bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function view(User $user, Listing $listing)
    {
        //
    }

    /**
     * Determine whether the user can create listings.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the listing.
     *
     * @param User $user
     * @param Listing $listing
     * @return mixed
     */
    public function update(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
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
        //
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
