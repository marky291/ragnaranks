<?php

namespace App\Listings;

use Illuminate\Support\Facades\DB;

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
//        $listing->ranking()->save(new ListingRanking);
    }

    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function creating(Listing $listing): void
    {
        $listing->slug ?: $listing->generateDefaultSlug();
    }
}
