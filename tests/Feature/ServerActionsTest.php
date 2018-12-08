<?php

namespace Tests\Feature;

use App\Server;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerActionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup
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
        $server = factory(Server::class)->create();

        $response = $this->get("/server/{$server->slug}");

        $response->assertOk()->assertViewHas('server');

        $data = $response->getOriginalContent()->getData()['server'];

        $this->assertEquals($server->name, $data['name']);
    }
}
