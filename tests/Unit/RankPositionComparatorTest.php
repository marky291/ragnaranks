<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\Events\Clicked;
use Illuminate\Support\Facades\Cache;

class RankPositionComparatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_ranking_position_on_click_fills_missing_ranks(): void
    {
        Cache::shouldReceive('forget');

        $listing = factory(Listing::class)->create();
        $listing->ranking()->update(['rank' => 3, 'points' => 43, 'votes' => 6, 'clicks' => 1]);

        $listing2 = factory(Listing::class)->create();
        $listing2->ranking()->update(['rank' => 1, 'points' => 0, 'votes' => 0, 'clicks' => 0]);

        // when we dispatch a click event, we validate position.
        Clicked::dispatch($listing);

        // the ranks should be updated.
        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => $listing->getkey()]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => $listing2->getkey()]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_deleted_ranking_listing_position(): void
    {
        Cache::shouldReceive('forget');

        $listing = factory(Listing::class)->create();
        $listing->ranking->update(['rank' => 3, 'points' => 43, 'votes' => 6, 'clicks' => 1]);

        $listing3 = factory(Listing::class)->create(['deleted_at' => now()]);
        $listing3->ranking->update(['rank' => 1, 'points' => 0, 'votes' => 0, 'clicks' => 0]);

        $listing2 = factory(Listing::class)->create();
        $listing2->ranking->update(['rank' => 1, 'points' => 0, 'votes' => 0, 'clicks' => 0]);

        // when we dispatch a click event, we validate position.
        Clicked::dispatch($listing);

        // the ranks should be updated.
        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'listing_id' => $listing->getkey()]);
        $this->assertDatabaseHas('listing_rankings', ['rank' => 2, 'listing_id' => $listing2->getkey()]);
    }
}
