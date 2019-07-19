<?php

namespace App\Providers;

use App\Listeners\SyncRankingVote;
use App\Listeners\SyncRankingClick;
use App\Listings\ListingVotedEvent;
use App\Listings\ListingClickedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\ConfirmRankingPosition;
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
        ListingVotedEvent::class => [
            SyncRankingVote::class,
            ConfirmRankingPosition::class,
        ],
        ListingClickedEvent::class => [
            SyncRankingClick::class,
            ConfirmRankingPosition::class,
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
