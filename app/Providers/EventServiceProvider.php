<?php

namespace App\Providers;

use App\Events\Viewed;
use App\Listeners\TrackViewedContent;
use App\Listings\Clicks\WebsiteWasClicked;
use App\Listings\Votes\ListingWasVoted;
use Illuminate\Support\Facades\Event;
use App\Listings\RankPositionComparator;
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
        Viewed::class => [
            TrackViewedContent::class,
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
