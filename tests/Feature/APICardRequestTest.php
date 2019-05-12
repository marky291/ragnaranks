<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class APICardRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_json_response()
    {
        $this->createListing([], 3, 3);

        $response = $this->json('get', '/api/cards');

        $response->assertJson([['id' => 1]]);
    }
}