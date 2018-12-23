<?php

namespace App\Listings;

use App\Periods;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
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
        Listing::observe(ListingObserver::class);
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
            if (!Cache::has('listings')) {
                GenerateListingsCache::dispatchNow();
            }

            return Cache::get('listings');
        });
    }
}
