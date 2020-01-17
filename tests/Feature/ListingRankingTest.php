<?php

namespace Tests\Feature;

use App\Listings\Listing;
use App\Listings\ListingRanking;
use Tests\TestCase;
use App\Console\Commands\RankingRebuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingRankingTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_retrieve_a_rank()
    {
        $listing = $this->createListing([], 0, 0);

        $this->artisan(RankingRebuilder::class);

        $this->assertEquals(1, $listing->ranking->rank);
    }

    public function test_it_can_retrieve_votes()
    {
        $listing = $this->createListing([], 1, 0);

        $this->artisan(RankingRebuilder::class);

        $this->assertEquals(1, $listing->ranking->votes);
    }

    public function test_it_can_retrieve_clicks()
    {
        $listing = $this->createListing([], 0, 1);

        $this->artisan(RankingRebuilder::class);

        $this->assertEquals(1, $listing->ranking->clicks);
    }

    public function test_it_can_retrieve_points()
    {
        $listing = $this->createListing([], 1, 1);

        $this->artisan(RankingRebuilder::class);

        $this->assertEquals(8, $listing->ranking->points);
    }

    public function test_it_can_process_ranking_with_deleted_ranking_above()
    {
        /** @var Listing $listing1 */
        $listing1 = $this->createListing([], 0, 0);
        $listing2 = $this->createListing([], 1, 0);

        // leave a gap between the ranks.
        $listing1->ranking->update(['rank' => 42, 'votes' => 0, 'clicks' => 0]);
        $listing2->ranking->update(['rank' => 49, 'votes' => 5, 'clicks' => 1]);

        $this->artisan(RankingRebuilder::class);

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => $listing2->id, 'rank' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['listing_id' => $listing1->id, 'rank' => 2]);
    }
}
