<?php

namespace App\Listings;

/**
 * Class ListingObserver.
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
        AddListingToContainer::dispatchNow($listing);
    }

    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function creating(Listing $listing)
    {
        $listing->slug ?: $listing->generateDefaultSlug();
    }
}
