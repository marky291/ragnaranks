<?php

namespace App\Providers;

use App\Interactions\Review;
use App\Observers\ReviewObserver;
use App\Listings\ListingConfiguration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\ConfigurationObserver;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Review::observe(ReviewObserver::class);

        ListingConfiguration::observe(ConfigurationObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        Resource::withoutWrapping();
    }
}
