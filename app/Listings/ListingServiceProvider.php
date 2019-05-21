<?php

namespace App\Listings;

use Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ListingServiceProvider
 *
 * @package App\Listings
 */
class ListingServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy(Listing::class, ListingPolicy::class);

        Listing::observe(ListingObserver::class);

        Route::bind('listing', function ($value) {
            return app('listings')->where('slug', $value)->first() ?? abort(404);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // cards are what the user browses on front page. [cached]
        $this->app->singleton('cards', static function () {
            return CardCacheContainer::dispatchNow();
        });

        // listings are everything... [cached]
        $this->app->singleton('listings', static function() {
            return ListingCacheContainer::dispatchNow();
        });
    }
}
