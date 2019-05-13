<?php

namespace Tests\Feature;

use mysql_xdevapi\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingRequestsTest extends TestCase
{
    public function test_it_loads_initial_listings_on_the_homepage()
    {
        $this->withoutExceptionHandling();

        $this->createListing(['name' => 'third'], 2, 2);

        $this->createListing(['name' => 'second'], 6, 6);

        $this->createListing(['name' => 'first'], 10, 10);

        $response = $this->get('/');

        $response->assertOk()->assertViewIs('listing.index')->assertViewHas('listings');

        $this->assertEquals('first', $this->viewData($response)->first()->name);

        $this->assertEquals('third', $this->viewData($response)->last()->name);
    }

    public function test_it_loads_the_server_profile()
    {
        $this->withoutExceptionHandling();

        $listing = $this->createListing([], 0, 0);

        $response = $this->get("/listing/{$listing->slug}");

        $this->assertNotNull($response->original->listing->name);

        $response->assertOk()->assertViewIs('listing.show')->assertViewHas('listing');
    }

    public function test_it_can_get_a_json_response_from_queryAPI()
    {
        $listing = $this->createListing([], 0, 0);

        $response = $this->json('get','/servers/all/all/all/all/1');

        $response->assertJson([['name' => $listing->name]]);
    }

    public function test_it_returns_ordered_rank_from_queryAPI()
    {
        $listing2 = $this->createListing(['name' => 'last'], 0, 0);
        $listing1 = $this->createListing(['name' => 'first'],  5, 5);

        $response = $this->json('get', '/servers/all/all/all/rank/2');

        $collection = collect($response->original);

        $this->assertEquals('first', $collection->first()->name);
        $this->assertEquals('last', $collection->last()->name);
    }
}
