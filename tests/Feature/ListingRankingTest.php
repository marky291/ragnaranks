<?php

namespace Tests\Feature;

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
}
