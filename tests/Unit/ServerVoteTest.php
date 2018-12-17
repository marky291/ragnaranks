<?php

namespace Tests\Unit;

use App\Interaction\Vote;
use App\Server;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerVoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_server_can_have_votes()
    {
        /** @var Server $server */
        $server = factory('App\Server')->create();

        factory(Vote::class, 3)->create(['server_id' => $server->id]);

        $this->assertEquals(3, $server->votes()->count());
    }

    /**
     * @test
     */
    public function a_daily_vote_trend_can_be_calculated()
    {
        /** @var Server $server */
        $server = factory(Server::class)->create();

        factory(Vote::class, 34)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subDays(1)]);
        factory(Vote::class, 64)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subDays(2)]);

        $this->assertEquals(-46.88, Vote::getServerTrend($server));
    }
}
