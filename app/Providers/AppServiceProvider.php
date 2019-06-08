<?php

namespace App\Providers;

use App\Listings\ListingConfiguration;
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
    public function boot()
    {
        ListingConfiguration::observe(ConfigurationObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Resource::withoutWrapping();
    }
}
