<?php

namespace Tests\Feature;

use App\Http\Controllers\ClickController;
use App\Http\Controllers\VoteController;
use App\Listings\Listing;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankPositionComparatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_listing_is_ranked_first()
    {
        $listing = factory(Listing::class)->create(['name' => 'foo']);

        app(ClickController::class)->processClick($listing);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => 1]);
    }

    public function test_two_rankings_can_exist()
    {
        $listing = factory(Listing::class)->create(['name' => 'foo']);

        app(ClickController::class)->processClick($listing);

        $listing = factory(Listing::class)->create(['name' => 'bar']);

        app(ClickController::class)->processClick($listing);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => 2]);
    }

    public function test_recursive_listing_change_to_first_place()
    {
        $listing1 = factory(Listing::class)->create(['name' => 'foo']);
        $listing2 = factory(Listing::class)->create(['name' => 'bar']);

        app(ClickController::class)->processClick($listing2);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => $listing2->getKey()]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => $listing1->getKey()]);
    }

    public function test_no_change_in_listing_rank_position()
    {
        $this->signIn();

        $listing1 = factory(Listing::class)->create(['name' => 'foo']);

        app(VoteController::class)->processVote($listing1);

        $listing2 = factory(Listing::class)->create(['name' => 'bar']);

        app(ClickController::class)->processClick($listing2);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => 2]);
    }

    public function test_listing_rank_does_not_compare_deleted_listings()
    {
        $this->markTestIncomplete(
            'Requires checks on the listing created observer!'
        );

        $listing1 = factory(Listing::class)->create(['id' => 1]);
        $listing2 = factory(Listing::class)->create(['id' => 2]);

        // delete listing two
        $listing2->delete();

        // add a new listing after deleting one. (should set a rank ignoring deleted)
        $listing3 = factory(Listing::class)->create(['id' => 3]);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => 3]);
    }
}
