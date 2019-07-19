<?php

namespace App\Listeners;

use App\Listings\ListingRanking;
use App\Listings\ListingVotedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncRankingVote
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
     * @param  ListingVotedEvent  $event
     * @return void
     */
    public function handle(ListingVotedEvent $event)
    {
        ListingRanking::incrementVote($event->listing);
    }
}
