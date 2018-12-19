<?php

namespace App\Listings;

use Illuminate\Support\ServiceProvider;

/**
 * Class ListingServiceProvider
 *
 * @package App\Listings
 */
class ListingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('listings', function($app) {
            return cache()->rememberForever('listings', function() {
                return Listing::with(['mode', 'tags'])->get();
            });
        });
    }
}
