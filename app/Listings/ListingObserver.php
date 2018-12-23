<?php

namespace App\Listings;

use Illuminate\Support\Facades\Cache;

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
        AddListingToContainer::dispatchNow($listing);
    }
}
