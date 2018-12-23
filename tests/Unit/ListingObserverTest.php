<?php

namespace Tests\Unit;

use App\Listings\Listing;
use Illuminate\Support\Facades\Cache;
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
        app('listings');

        factory(Listing::class)->create(['id' => 25]);

        $this->assertSame(25, app('listings')->first()->rank);
    }
}
