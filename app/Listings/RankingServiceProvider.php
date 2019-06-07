<?php

namespace App\Listings;

use App\Http\Resources\ListingResource;
use App\Jobs\BuildListingRankingTable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
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
