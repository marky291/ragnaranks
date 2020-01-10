<?php


namespace Tests\Unit;

use App\Listings\Listing;
use Tests\TestCase;

class ListingHeartbeat extends TestCase
{
    public function test_it_has_no_recorder()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        $this->assertFalse($listing->heartbeat->hasRecorder());
    }
}
