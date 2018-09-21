<?php

namespace Tests\Unit;

use App\Server;
use App\ServerMode;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerModeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_server_can_have_a_mode()
    {
        /** @var Server $server */
        $server = factory('App\Server')->create();

        $this->assertNotNull($server->mode->name);
    }
}
