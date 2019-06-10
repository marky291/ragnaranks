<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Jobs\BuildListingRankingTable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingRankingTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_retrieve_a_rank()
    {
        $listing = $this->createListing([], 0, 0);

        BuildListingRankingTable::dispatchNow();

        $this->assertEquals(1, $listing->ranking->rank);
    }

    public function test_it_can_retrieve_votes()
    {
        $listing = $this->createListing([], 1, 0);

        BuildListingRankingTable::dispatchNow();

        $this->assertEquals(1, $listing->ranking->votes);
    }

    public function test_it_can_retrieve_clicks()
    {
        $listing = $this->createListing([], 0, 1);

        BuildListingRankingTable::dispatchNow();

        $this->assertEquals(1, $listing->ranking->clicks);
    }

    public function test_it_can_retrieve_points()
    {
        $listing = $this->createListing([], 1, 1);

        BuildListingRankingTable::dispatchNow();

        $this->assertEquals(7, $listing->ranking->points);
    }
}