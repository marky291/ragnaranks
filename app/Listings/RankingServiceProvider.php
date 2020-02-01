<?php

namespace App\Listings;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

/**
 * Class RankingServiceProvider.
 */
class RankingServiceProvider extends ServiceProvider
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
    }
}
