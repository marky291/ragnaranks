<?php

namespace Tests\Unit;

use App\Click;
use App\Listings\Listing;
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
    public function it_has_a_route_key_name()
    {
        $this->assertEquals('slug', (new Listing)->getRouteKeyName());
    }

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
    public function it_has_statistics()
    {
        $server = factory(Listing::class)->create();

        $this->assertNotNull($server->statistics);
    }

    /**
     * @test
     */
    public function it_has_an_owner()
    {
        $this->signIn();

        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['user_id' => auth()->id()]);

        $this->assertSame(auth()->id(), $listing->user->id);
    }

    /**
     * @test
     */
    public function it_has_tags()
    {
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
    public function it_can_have_a_low_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.low-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('Low Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_mid_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.mid-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('Mid Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.high-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('High Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_super_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.high-rate.max') + 1;

        $listing->configs = $array;

        $this->assertEquals('Super High Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_pulls_cached_servers_from_the_container()
    {
        factory(Listing::class, 5)->create();

        $servers = app('listings');

        $this->assertCount(5, $servers);
    }
}
