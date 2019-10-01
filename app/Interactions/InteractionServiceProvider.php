<?php

namespace App\Interactions;

use App\Reviews\Review;
use Illuminate\Support\Facades\Gate;
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

        Click::observe(InteractionObserver::class);

        Review::observe(InteractionObserver::class);

        /** @depreciated Unable to find class */
        //Gate::policy(Interaction::class, InteractionPolicy::class);
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
