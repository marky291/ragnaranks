<?php

namespace Tests\Feature;

use App\Http\Requests\StoreListingRequest;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\ListingConfiguration;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => $createdListing->getKey()]);
    }

    public function test_listing_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $listing = factory(Listing::class)->create([
            'name' => 'foo'
        ]);

        $configs  = factory(ListingConfiguration::class)->make([
            'base_exp_rate' => 20,
            'pk_mode' => true,
            'arrow_decrement' => true,
            'attribute_recover' => false,
        ]);

        $listing->configuration()->save($configs);

        $this->assertDatabaseHas('listings', ['name' => 'foo']);
        $this->assertDatabaseHas('listing_configurations', [
            'exp_title' => 'low-rate',
            'pk_mode' => 1,
            'arrow_decrement' => 1,
            'attribute_recover' => 0
        ]);

        $response = $this->patch("/listing/{$listing->slug}", array_merge($listing->toArray(),
            ['name' => 'foo'],
            ['tags' => ['freebies', 'guild-pack']],
            ['config' => array_merge($configs->toArray(),
                [
                    'base_exp_rate' => 200,
                    'pk_mode' => false,
                    'item_drop_card' => 300,
                    'attribute_recover' => true,
                ])
            ]
        ));

        $response->assertOk();
        $this->assertDatabaseHas('listings', ['name' => 'foo']);
        $this->assertDatabaseHas('listing_configurations', [
            'exp_title' => 'mid-rate',
            'pk_mode' => 0,
            'item_drop_card' => 300,
            'attribute_recover' => 1,
        ]);

    }
}
