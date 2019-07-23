<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_vote_stats()
    {
        $response = $this->get('/api/voting/stats');

        $response->assertJson(array_merge(config('action.vote'),
            [
                'total' => 1,
                'spread' => config('action.vote.spread'),
                'value' => 7,
                'concluded' => 0,
            ]
        ));
    }

    public function test_it_can_store_clicks()
    {
        $listing = $this->createListing(['name' => 'foo'], 0, 0);

        $this->post('/listing/foo/clicks');

        $this->assertDatabaseHas('clicks', ['listing_id' => $listing->getKey()]);
    }

    public function test_it_can_validate_name()
    {
        $this->createListing(['name' => 'foo'],0,0);

        $response = $this->get('/api/listing/bar/available');

        $response->assertJson(['name' => 'bar']);

        $response = $this->get('/api/listing/foo/available');

        $response->assertSessionHasErrors('name');
    }
}
