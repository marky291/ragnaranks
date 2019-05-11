<?php

namespace App\Listings;

use Illuminate\Support\Facades\Cache;
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
        $this->app->singleton('listings', function($app)
        {
            Cache::forget('listings');

            if (!Cache::has('listings')) {
                CacheListingsContainer::dispatchNow();
            }

            return Cache::get('listings');
        });
    }
}
