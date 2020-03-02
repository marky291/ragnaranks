<?php

namespace App\Providers;

use App\Listeners\TrackViewedContent;
use App\Listings\Listeners\CompareRankingPoints;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\Viewed::class => [
            TrackViewedContent::class,
        ],
        \App\Listings\Events\Voted::class => [
            CompareRankingPoints::class,
        ],
        \App\Listings\Events\Clicked::class => [
            CompareRankingPoints::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
