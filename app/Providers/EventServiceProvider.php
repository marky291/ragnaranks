<?php

namespace App\Providers;

use App\Listings\ListingClickedEvent;
use App\Listings\ListingVotedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\ConfirmRankingPosition;
use App\Listeners\SyncRankingClick;
use App\Listeners\SyncRankingVote;

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
        ListingVotedEvent::class => [
            SyncRankingVote::class,
            ConfirmRankingPosition::class
        ],
        ListingClickedEvent::class => [
            SyncRankingClick::class,
            ConfirmRankingPosition::class,
        ]
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
