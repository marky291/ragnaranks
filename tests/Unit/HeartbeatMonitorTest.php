<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Listings\ListingHeartbeat;
use Tests\TestCase;
use App\Heartbeats\HeartbeatMonitor;

class HeartbeatMonitorTest extends TestCase
{

    public function test_it_has_a_hearbeat_to_monitor()
    {
        $listing = factory(Listing::class)->create();

        $monitor = new HeartbeatMonitor($listing);

        $this->assertInstanceOf(ListingHeartbeat::class, $monitor->getHeartbeat());
    }

    public function test_it_can_examine_site_with_informer_data()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/']);

        $monitor = new HeartbeatMonitor($listing);

        $this->assertEquals(true, $monitor->hasInformer());
    }

    public function test_it_does_not_examine_sites_without_informer_data()
    {
        $listing = factory(Listing::class)->create();

        $monitor = new HeartbeatMonitor($listing);

        $this->assertEquals(false, $monitor->hasInformer());
    }

    public function it_does_not_examine_websites_without_status_200()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://reg.lupon-ro.net/feokfoe']);

        $monitor = new HeartbeatMonitor($listing);

        $this->assertEquals(false, $monitor->hasInformer());
    }
}
