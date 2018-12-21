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
     * Handle the app listings listing "created" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function created(Listing $listing)
    {
        //$listing->update(['statistics->rank' => $listing->id]);
    }
}
