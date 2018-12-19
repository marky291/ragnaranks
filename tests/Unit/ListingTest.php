<?php

namespace Tests\Unit;

use App\Click;
use App\Listings\Listing;
use App\Listings\ListingConfig;
use App\Tag;
use App\Vote;
use Illuminate\Support\Facades\Cache;
use Mockery\Mock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ListingTest
 *
 * @package Tests\Unit
 */
class ListingTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_a_mode()
    {
        /** @var Listing $server */
        $server = factory(Listing::class)->create();

        $this->assertNotNull($server->mode->name);
    }

    /**
     * @test
     */
    public function it_has_a_config()
    {
        $server = factory(Listing::class)->create();

        $this->assertNotNull($server->configs);
    }

    /**
     * @test
     */
    public function it_has_tags()
    {
        /** @var Listing $server */
        $server = factory(Listing::class)->create();

        $server->tags()->save(Tag::all()->random());

        $this->assertCount(1, $server->tags);
    }

    /**
     * @test
     */
    public function it_has_a_vote_interaction()
    {
        $server = factory(Listing::class)->create();

        $vote = factory(Vote::class)->create();

        $server->votes()->save($vote);

        $this->assertCount(1, $server->votes);
    }

    /**
     * @test
     */
    public function it_has_a_click_interaction()
    {
        $server = factory(Listing::class)->create();

        $click = factory(Click::class)->create();

        $server->clicks()->save($click);

        $this->assertCount(1, $server->clicks);
    }

    /**
     * @test
     */
    public function it_pulls_cached_servers_from_the_container()
    {
        Cache::shouldReceive('rememberForever')->once()->with('listings', \Closure::class)->andReturn(factory(Listing::class, 5)->create());

        $servers = app('listings');

        $this->assertCount(5, $servers);
    }
}
