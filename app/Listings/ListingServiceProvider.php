<?php

namespace App\Listings;

use App\Listings\Reviews\Review;
use App\Listings\Reviews\ReviewObserver;
use Illuminate\Support\ServiceProvider;

class ListingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Review::observe(ReviewObserver::class);
    }
}
