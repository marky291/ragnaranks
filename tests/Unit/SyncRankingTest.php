<?php

namespace Tests\Unit;

use App\Http\Controllers\ClickController;
use App\Http\Controllers\ListingVoteController;
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
        $listing = factory(Listing::class)->create();

        app(ListingVoteController::class)->processVote($listing);

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 1, 'votes' => 1, 'points' => 7]);
    }

    public function test_listing_clicked_event_syncs_ranking_table_and_points()
    {
        $listing = factory(Listing::class)->create();

        app(ClickController::class)->processClick($listing);

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 1, 'clicks' => 1, 'points' => 1]);
    }
}
