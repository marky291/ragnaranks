<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Listings\Listing;

class ListingObserverTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_rank_from_the_id()
    {
        app('listings');

        factory(Listing::class)->create(['id' => 25]);

        $this->assertSame(25, app('listings')->first()->rank);
    }
}
