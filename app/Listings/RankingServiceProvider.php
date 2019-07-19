<?php

namespace App\Listings;

use Illuminate\Support\Facades\Gate;
use App\Jobs\ReconstructRankingTable;
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

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rankings', static function () {
//            dd(BuildListingRankingTable::dispatchNow());
        });
    }
}
