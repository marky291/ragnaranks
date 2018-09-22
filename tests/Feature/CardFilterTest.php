<?php

namespace Tests\Feature;

use App\Server;
use App\ServerClick;
use App\ServerVote;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardFilterTest extends TestCase
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
    public function the_index_page_filters_to_vote_count()
    {
        // create three servers with no votes.
        $servers = factory(Server::class, 3)->create();

        // add a vote to the server.
        factory(ServerVote::class, 1)->create(['server_id' => $servers[1]->id, 'created_at' => now()]);

        $response = $this->get('/');

        $response->assertOk()->assertViewHas('servers');

        $collection = $response->getOriginalContent()->getData()['servers'];

        // the second server, should show at the top.
        $this->assertEquals($servers[1]->name, $collection->first()->name);
    }

    /**
     * @test
     */
    public function the_filters_can_display_votes_during_a_period_of_days()
    {
        // create three servers with no votes.
        $server = factory(Server::class)->create();

        // add a vote to the server.
        factory(ServerVote::class, 1)->create(['server_id' => $server->id,'created_at' => Carbon::now()]);
        factory(ServerVote::class, 1)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subMonth(2)]);

        $response = $this->get('/filters/votes/period/days/30');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals(1, $data[0]->votes_count);
    }

    /**
     * @test
     */
    public function the_filters_can_display_clicks_during_a_period_of_days()
    {
        // create three servers with no votes.
        $server = factory(Server::class)->create();

        // add a vote to the server.
        factory(ServerClick::class, 1)->create(['server_id' => $server->id,'created_at' => Carbon::now()]);
        factory(ServerClick::class, 1)->create(['server_id' => $server->id, 'created_at' => Carbon::now()->subMonth(2)]);

        $response = $this->get('/filters/clicks/period/days/30');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals(1, $data[0]->clicks_count);
    }

    /**
     * @test
     */
    public function the_filters_can_filter_newest_entries()
    {
        $new_server = factory(Server::class)->create(['created_at' => now()]);

        $old_server = factory(Server::class)->create(['created_at' => now()->subDays(5)]);

        $response = $this->get('/filters/creation/desc');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals($new_server->id, $data[0]->id);
    }
}
