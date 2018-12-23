<?php

namespace App\Listings;

use App\Periods;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\Listener;
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
            $listings = Listing::query()->withCount(
                [
                    'votes' => function($query) {
                        $query->betweenPeriod(now(), now()->subDays(7));
                    },
                    'clicks' => function($query) {
                        $query->betweenPeriod(now(), now()->subDays(7));
                    }
                ]
            )->with(['mode', 'tags'])->get();

            $listings = $listings->sortByDesc(function(Listing $listing)  {
                return $listing->points;
            });

            $listings = $listings->values()->each(function (Listing $listing, int $key) {
                $listing->setAttribute('rank', $key + 1);
            });

            return $listings;
        });
    }
}
