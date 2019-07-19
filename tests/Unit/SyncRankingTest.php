<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Listings\Listing;
use App\Jobs\SyncRankingVote;
use App\Listings\ListingVotedEvent;
use App\Listings\ListingClickedEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property SyncRankingVote job
 */
class SyncRankingTest extends TestCase
{
    use RefreshDatabase;

    public function test_listing_voted_event_syncs_ranking_table_and_points()
    {
        ListingVotedEvent::dispatch(factory(Listing::class)->create());

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 1, 'votes' => 1, 'points' => 7]);
    }

    public function test_listing_clicked_event_syncs_ranking_table_and_points()
    {
        ListingClickedEvent::dispatch(factory(Listing::class)->create());

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 1, 'clicks' => 1, 'points' => 1]);
    }

    public function test_clicked_event_syncs_position()
    {
        $listingLast = factory(Listing::class)->create(['name' => 'foo']);
        ListingClickedEvent::dispatch($listingLast->fresh());

        $listingFirst = factory(Listing::class)->create(['name' => 'bar']);
        ListingClickedEvent::dispatch($listingFirst->fresh());
        ListingClickedEvent::dispatch($listingFirst->fresh());

        // load some first listing ranks.
        ListingClickedEvent::dispatch($listingLast->fresh());
        ListingClickedEvent::dispatch($listingLast->fresh());

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'points' => 3, 'listing_id' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'points' => 2, 'listing_id' => 2]);
    }
}
