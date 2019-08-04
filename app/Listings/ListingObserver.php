<?php

namespace App\Listings;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function created(Listing $listing): void
    {
        $listing->ranking()->save(new ListingRanking(['rank'=>ListingRanking::query()->max('rank') + 1]));
    }

    /**
     * Generate its unique space that will allow file uploading.
     *
     * @param Listing $listing
     */
    public function creating(Listing $listing): void
    {
        $listing->space = Str::uuid();
    }

    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function saving(Listing $listing): void
    {
        $listing->slug = Str::slug($listing->name);
    }
}
