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
    public function boot()
    {
        Schema::defaultStringLength(191);

        Review::observe(ReviewObserver::class);

        ListingConfiguration::observe(ConfigurationObserver::class);

        // change the file system space domain to itself if local.
        if (app()->environment('local')) {
            config()->set('filesystems.disks.spaces.domain', config('app.url'));
        }
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
