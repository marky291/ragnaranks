<?php

namespace Tests\Unit;

use App\Server;
use App\ServerClick;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerClickTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_server_can_have_clicks()
    {
        /** @var Server $server */
        $server = factory('App\Server')->create();

        factory('App\ServerClick', 3)->create(['server_id' => $server->id]);

        $this->assertEquals(3, $server->clicks()->count());
    }

    /**
     * @test
     */
    public function a_daily_trend_can_be_calculated()
    {
        /** @var Server $server */
        $server = factory(Server::class)->create();

        factory('App\ServerClick', 140)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subDays(1)]);
        factory('App\ServerClick', 72)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subDays(2)]);

        $this->assertEquals(94.44, ServerClick::getServerTrend($server));
    }
}
