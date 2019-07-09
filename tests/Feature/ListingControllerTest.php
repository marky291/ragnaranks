<?php

namespace Tests\Feature;

use App\Listings\Listing;
use App\Listings\ListingConfiguration;
use App\Tag;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ListingControllerTest extends TestCase
{
    public function test_it_loads_the_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_it_loads_the_server_profile()
    {
        $listing = $this->createListing([], 0, 0);

        $response = $this->get("/listing/{$listing->slug}");

        $response->assertOk()->assertViewIs('listing.profile');
    }

    public function test_storing_a_listing_requires_authentication()
    {
        $this->expectException(AuthenticationException::class);

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->make();

        $this->post('/listing', $listing->toArray());
    }

    public function test_listing_can_be_stored()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->make(['name' => 'foo']);

        $tags = ['tags' => ['freebies', 'guild-pack', 'mobile']];

        $configs = factory(ListingConfiguration::class)->make();

        $response = $this->post('/listing', array_merge($listing->toArray(), $tags, $configs->toArray()));

        $this->assertDatabaseHas('listings', ['name' => 'foo']);
    }
}
