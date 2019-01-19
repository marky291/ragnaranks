<?php

namespace App\Interactions;

use App\Interactions\InteractionObserver;
use App\Interactions\Review;
use App\Interactions\Vote;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Click::observe(InteractionObserver::class);

        Review::observe(InteractionObserver::class);

        Gate::policy(Interaction::class, InteractionPolicy::class);
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
