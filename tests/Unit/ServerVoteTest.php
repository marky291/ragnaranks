<?php

namespace Tests\Unit;

use App\Server;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerVoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_server_can_have_clicks()
    {
        /** @var Server $server */
        $server = factory('App\Server')->create();

        factory('App\ServerVote', 3)->create(['server_id' => $server->id]);

        $this->assertEquals(3, $server->votes()->count());
    }
}
