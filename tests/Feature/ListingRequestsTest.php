<?php

namespace Tests\Feature;

use Tests\TestCase;

class ListingRequestsTest extends TestCase
{
    public function test_it_loads_the_homepage()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_it_loads_the_server_profile()
    {
        $this->withoutExceptionHandling();

        $listing = $this->createListing([], 0, 0);

        $response = $this->get("/listing/{$listing->slug}");

        $response->assertOk()->assertViewIs('listing.profile');
    }
}
