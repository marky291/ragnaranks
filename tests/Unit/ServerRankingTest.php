<?php

namespace Tests\Unit;

use App\Interaction\Vote;
use App\Jobs\RankServerCollection;
use App\Server;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerRankingTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_rank_is_generated_for_a_single_server()
    {
        $first = factory(Server::class)->create();

        factory(Vote::class, 10)->create(['server_id' => $first->id]);

        RankServerCollection::dispatchNow(Server::all());

        $this->assertEquals(1, Server::query()->where('id', $first->id)->first()->rank);
    }

    /**
     * @test
     */
    public function a_rank_is_generated_for_multiple_servers()
    {
        $first  = factory(Server::class)->create(['votes_count' => 10, 'clicks_count' => 0]);
        $second = factory(Server::class)->create(['votes_count' => 5, 'clicks_count' => 0]);
        $third  = factory(Server::class)->create(['votes_count' => 2, 'clicks_count' => 0]);

        RankServerCollection::dispatchNow(Server::all());

        $this->assertEquals(1, Server::query()->where('id', $first->id)->first()->rank);
        $this->assertEquals(2, Server::query()->where('id', $second->id)->first()->rank);
        $this->assertEquals(3, Server::query()->where('id', $third->id)->first()->rank);
    }
}
