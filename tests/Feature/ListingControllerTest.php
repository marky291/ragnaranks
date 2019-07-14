<?php

namespace Tests\Feature;

use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\ListingConfiguration;
use Illuminate\Auth\AuthenticationException;

class ListingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

        $tags = ['freebies', 'guild-pack', 'mobile'];

        $configs = factory(ListingConfiguration::class)->make();

        $response = $this->post('/listing', array_merge($listing->toArray(),
            ['tags' => $tags],
            ['config' => $configs->toArray()]
        ));


        $this->assertDatabaseHas('listings', ['name' => 'foo']);

        $createdListing = Listing::whereName('foo')->first();

        $this->assertDatabaseHas('listing_tag', ['listing_id' => $createdListing->getKey(), 'tag_id' => 2]);

        $this->assertDatabaseHas('listing_configurations', array_merge($configs->toArray(),
            ['listing_id' => $createdListing->getKey()]));
    }
}
