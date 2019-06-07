<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Listings\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankingServiceProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_collection()
    {
        factory(Listing::class, 7)->create();

        $this->assertCount(7, app('rankings'));
    }

    public function test_it_can_retrieve_a_rank()
    {
        $listing = $this->createListing(['name' => 'foo'], 0, 0);

        $this->assertEquals(1, app('rankings')->get($listing->getKey()));
    }

    public function test_it_correctly_positions()
    {
        $listing1 = $this->createListing(['name' => 'foo'], 0, 0);

        $listing2 = $this->createListing(['name' => 'bar'], 1, 0);

        $listing3 = $this->createListing(['name' => 'bar'], 0, 0);

        $listing4 = $this->createListing(['name' => 'bar'], 0, 6);

        $listing5 = $this->createListing(['name' => 'bar'], 0, 0);

        $this->assertEquals(1, app('rankings')->get($listing2->getKey()));

        $this->assertEquals(2, app('rankings')->get($listing4->getKey()));
    }
}
