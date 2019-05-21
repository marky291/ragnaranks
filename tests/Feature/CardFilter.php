<?php

namespace Tests\Feature;

use App\Listings\Listing;
use App\Vote;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardFilter extends TestCase
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
        $server_one = factory(Listing::class)->create();

        $server_one->votes()->saveMany(factory(Vote::class, 3)->create());

        $server_two = factory(Listing::class)->create();

        $server_two->votes()->saveMany(factory(Vote::class, 2)->create());

        $response = $this->get('/');

        $response->assertOk()->assertViewHas('servers');

        $collection = $response->getOriginalContent()->getData()['servers'];

        // the second listing, should show at the top.
        $this->assertEquals($server_one->name, $collection->first()->name);
    }

    /**
     * @test
     */
    public function the_filters_can_display_votes_during_a_period_of_days()
    {
        $server = factory(Listing::class)->create();

        $server->votes()->saveMany(factory(Vote::class, 3)->create());

        $response = $this->get('/servers/all/all/votes_count/desc');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals(1, $data[0]->votes());
    }

    /**
     * @test
     */
    public function the_filters_can_display_clicks_during_a_period_of_days()
    {
        // create three servers with no votes.
        factory(Listing::class)->create(['clicks_count' => 1]);

        $response = $this->get('/servers/all/all/clicks_count/desc');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals(1, $data[0]->clicks_count);
    }

    /**
     * @test
     */
    public function the_filters_can_filter_newest_entries()
    {
        $new_server = factory(Listing::class)->create(['created_at' => now()]);

        $old_server = factory(Listing::class)->create(['created_at' => now()->subDays(5)]);

        $response = $this->get('/servers/all/all/created_at/desc');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals($new_server->id, $data[0]->id);
    }

    /**
     * @test
     */
    public function the_filters_can_filter_by_episode_version()
    {
        $olders_version = factory(Listing::class)->create(['episode' => 11.00]);

        $newest_version = factory(Listing::class)->create(['episode' => 13.00]);

        $response = $this->get('/servers/all/all/episode/desc');

        $response->assertOk()->assertViewHas('servers');

        $data = $response->getOriginalContent()->getData()['servers'];

        $this->assertEquals($newest_version->id, $data[0]->id);
    }

    /**
     * @test
     */
    public function it_can_correctly_get_the_exp_groups_for_filtering()
    {
        $server = factory(Listing::class, 3)->create();

        $server[0]->config()->update(['base_exp_rate' => config('filter.exp.low-rate.max')]);
        $server[1]->config()->update(['base_exp_rate' => config('filter.exp.mid-rate.max')]);
        $server[2]->config()->update(['base_exp_rate' => config('filter.exp.high-rate.max')]);

        $this->assertEquals('Low Rate', $server[0]->exp_group);
        $this->assertEquals('Mid Rate', $server[1]->exp_group);
        $this->assertEquals('High Rate', $server[2]->exp_group);
    }

    /**
     * @test
     */
    public function it_can_display_an_exp_group_as_a_filter()
    {
        $server = factory(Listing::class, 3)->create();

        $server[0]->config()->update(['base_exp_rate' => config('filter.exp.low-rate.max')]);
        $server[1]->config()->update(['base_exp_rate' => config('filter.exp.mid-rate.max')]);
        $server[2]->config()->update(['base_exp_rate' => config('filter.exp.high-rate.max')]);

        $response = $this->get('/servers/low-rate/all/votes_count/desc');

        $response->assertOk()->assertViewHas('servers');

        $collection = $response->getOriginalContent()->getData()['servers'];

        /** @var Listing $item */
        foreach ($collection as $server)
        {
            $this->assertEquals('Low Rate', $server->exp_group);
        }
    }

    /**
     * @test
     */
    public function it_can_filter_by_mode()
    {
        $server = factory(Listing::class, 2)->create();

        $server[0]->mode->update(["name" => "renewal"]);
        $server[1]->mode->update(["name" => "pre-renewal"]);

        $response = $this->get('/servers/all/renewal/votes_count/desc');

        $response->assertOk()->assertViewHas('servers');

        $collection = $response->getOriginalContent()->getData()['servers'];

        foreach ($collection as $item)
        {
            $this->assertEquals('renewal', $item->mode->name);
        }
    }
}
