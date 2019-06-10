<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 20/12/2018
 * Time: 11:40.
 */

namespace App\Listings;

use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ListingFilter.
 *
 * Allows filtering Based on the url query input.
 */
class ListingCollection extends Collection
{

    /**
     * Filter out a listing based on its modes.
     *
     * @param string $mode
     *
     * @return ListingCollection
     */
    public function filterMode(string $mode = 'all'): self
    {
        if (in_array($mode, ['renewal', 'pre-renewal', 'classic', 'custom'])) {
            return $this->filter(static function (Listing $listing) use ($mode) {
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
     * @return ListingCollection
     */
    public function filterGroup(string $rate = 'all')
    {
        if (in_array($rate, ['official-rate', 'low-rate', 'mid-rate', 'high-rate', 'super-high-rate'])) {
            return $this->filter(static function (Listing $listing) use ($rate) {
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
     * @return ListingCollection
     */
    public function filterOwner(User $user)
    {
        return $this->filter(function (Listing $listing) use ($user) {
            return $listing->user->is($user);
        });
    }

    /**
     * Filter out listings that have a specific tag.
     *
     * @param string $tag
     * @return ListingCollection
     */
    public function filterTag(string $tag)
    {
        if (in_array($tag, Tag::all()->pluck('tag')->toArray(), true)) {
            return $this->filter(static function (Listing $listing) use ($tag) {
                return $listing->tags->contains('tag', $tag);
            });
        }

        return $this;
    }

    /**
     * Sort the filter based on a key entry.
     *
     * @param string $key
     * @return $this|ListingCollection
     */
    public function filterSort(string $key = 'all')
    {
        if (in_array($key, ['episode', 'created_at'])) {
            return $this->sortByDesc($key);
        }

        if (in_array($key, ['name', 'rank'])) {
            return $this->sortBy($key);
        }

        return $this;
    }
}
