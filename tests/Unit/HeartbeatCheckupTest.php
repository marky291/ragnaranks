<?php

namespace Tests\Unit;

use App\Heartbeats\HeartbeatCheckup;
use App\Listings\Listing;
use App\Listings\ListingHeartbeat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeartbeatCheckupTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_examine_site_with_informer_data()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/']);

        $checkup = new HeartbeatCheckup($listing);

        $this->assertEquals(true, $checkup->hasInformer());
    }

    public function test_it_does_not_examine_sites_without_informer_data()
    {
        $listing = factory(Listing::class)->create();

        $checkup = new HeartbeatCheckup($listing);

        $this->assertEquals(false, $checkup->hasInformer());
    }

    public function test_it_can_retrieve_informer_data()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/']);

        $checkup = new HeartbeatCheckup($listing);

        $this->assertEquals(true, $checkup->hasInformer());
    }

    public function test_it_can_store_state_as_offline_for_previously_registered_informers()
    {
        // should only store as offline, if it was ever connected in first place...
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/']);

        $checkup = (new HeartbeatCheckup($listing))->recordResults();

        $listing->website = 'http://foo.com';

        $checkup = (new HeartbeatCheckup($listing))->recordResults();

        $this->assertCount(2, $listing->heartbeats);
    }

    public function test_it_can_write_to_database_the_entry()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/']);

        $checkup = new HeartbeatCheckup($listing);

        $checkup->recordResults();

        $this->assertDatabaseHas('listing_heartbeats', ['listing_id' => $listing->id]);
    }
}
