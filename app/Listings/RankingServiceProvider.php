<?php

namespace App\Listings;

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
            return Cache::remember('rankingTable', 30, static function () {
                $table = new Collection();

                $listings = Listing::withCount(['votes', 'clicks'])->get()->withRanking();

                foreach ($listings as $position => $listing) {
                    $table->put($listing->getKey(), ++$position);
                }

                return $table;
            });
        });
    }
}
