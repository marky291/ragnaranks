<?php

namespace Tests\Unit;

use App\Listings\Listing;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingObserverTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_rank_from_the_id()
    {
        $listing = factory(Listing::class)->create();

        $this->assertSame(1, $listing->statistics['rank']);
    }
}
