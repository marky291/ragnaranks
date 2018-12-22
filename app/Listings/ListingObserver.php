<?php

namespace App\Listings;

/**
 * Class ListingObserver
 *
 * @package App\Listings
 */
class ListingObserver
{
    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function created(Listing $listing)
    {
        if (! isset($listing->statistics['rank'])) {
            $listing->update(['statistics->rank' => $listing->id]);
        }

    }
}
