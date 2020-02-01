<?php

namespace App\Providers;

use App\Listings\Clicks\WebsiteWasClicked;
use App\Listings\Votes\ListingWasVoted;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listings\RankPositionComparator;
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
        ListingWasVoted::class => [
            RankPositionComparator::class,
        ],
        WebsiteWasClicked::class => [
            RankPositionComparator::class,
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
