<?php

namespace App\Listeners;

use App\Listings\ListingClickedEvent;
use App\Listings\ListingRanking;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncRankingClick
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ListingClickedEvent  $event
     * @return void
     */
    public function handle(ListingClickedEvent $event)
    {
        ListingRanking::incrementClick($event->listing);
    }
}
