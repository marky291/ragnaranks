<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 20/12/2018
 * Time: 11:40
 */

namespace App\Listings;

use App\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ListingFilter
 *
 * Allows filtering Based on the url query input.
 *
 * @package App\Listings
 */
class ListingFilter extends Collection
{
    /**
     * Filter out a listing based on its modes.
     *
     * @param string $mode
     *
     * @return ListingFilter
     */
    public function filterMode(string $mode = "all")
    {
        if (in_array($mode, ['renewal', 'pre-renewal', 'classic', 'custom'])) {
            return $this->filter(function(Listing $listing) use ($mode) {
                return $listing->mode->name == $mode;
            });
        }

        return $this;
    }

    /**
     * Filter out a listing based on its exp rate group.
     *
     * @param string $rate
     *
     * @return ListingFilter
     */
    public function filterGroup(string $rate = "all")
    {
        if (in_array($rate, ['low-rate', 'mid-rate', 'high-rate', 'custom', 'classic'])) {
            return $this->filter(function(Listing $listing) use ($rate) {
                return ucwords(str_replace('-', ' ', $rate)) == $listing->expRateTitle;
            });
        }

        return $this;
    }

    /**
     * Filter out the listings belonging to a certain owner/user.
     *
     * @param User $user
     *
     * @return ListingFilter
     */
    public function filterOwner(User $user)
    {
        return $this->filter(function(Listing $listing) use ($user) {
            return $listing->user->is($user);
        });
    }

    /**
     * Sort the filter based on a key entry.
     *
     * @param string $key
     * @return $this|ListingFilter
     */
    public function filterSort(string $key = "any")
    {
        if (in_array($key, ['episode', 'created_at', 'votes_count', 'clicks_count'])) {
            return $this->sortByDesc($key);
        }

        if (in_array($key, ['name', 'rank'])) {
            return $this->sortBy($key);
        }

        return $this;
    }
}