<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 20/12/2018
 * Time: 11:40
 */

namespace App\Listings;

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
     * Filter out a server based on its modes.
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
     * Filter out a server based on its exp rate group.
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
     * Sort the filter based on a key entry.
     *
     * @param string $key
     * @return $this|ListingFilter
     */
    public function filterSort(string $key = "any")
    {
        if (in_array($key, ['name', 'episode', 'created_at'])) {
            return $this->sortBy($key);
        }

        if (in_array($key, ['rank', 'vote_count', 'clicks_count', 'rank_growth', 'votes_trend', 'clicks_trend']))
        {
            return $this->sortBy("statistics.{$key}");
        }

        return $this;
    }
}