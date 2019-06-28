<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Listings\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerActionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function the_server_can_be_viewed()
    {
        $server = factory(Listing::class)->create();

        $response = $this->get("/listing/{$server->slug}");

        $response->assertOk()->assertViewHas('listing');

        $data = $response->getOriginalContent()->getData()['listing'];

        $this->assertEquals($server->name, $data['name']);
    }
}
