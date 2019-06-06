<?php

namespace App\Listings;

use App\Jobs\RankListings;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ListingServiceProvider.
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
        $this->app->singleton('rankings', static function()
        {
            return Cache::remember('rankingTable', 30, static function()
            {
                $table = new Collection();

                $listings = Listing::withCount(['votes','clicks'])->get()->withRanking();

                foreach ($listings as $position => $listing)
                {
                    $table->put($listing->getKey(), ++$position);
                }

                return $table;
            });
        });
    }
}
