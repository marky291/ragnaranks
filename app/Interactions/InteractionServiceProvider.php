<?php

namespace App\Interactions;

use App\Interactions\InteractionObserver;
use App\Interactions\Review;
use App\Interactions\Vote;
use Illuminate\Support\ServiceProvider;

class InteractionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Vote::observe(InteractionObserver::class);

        Review::observe(InteractionObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
