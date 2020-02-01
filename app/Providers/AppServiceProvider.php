<?php

namespace App\Providers;

use App\Listings\Interactions\Reviews\Review;
use App\Listings\Interactions\Reviews\ReviewObserver;
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
