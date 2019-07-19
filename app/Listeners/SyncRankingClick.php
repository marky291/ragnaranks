<?php

namespace App\Listeners;

use App\Listings\ListingRanking;
use App\Listings\ListingClickedEvent;

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
