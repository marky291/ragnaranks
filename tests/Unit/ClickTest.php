<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\Votes\Vote;
use App\Listings\Clicks\Click;

class ClickTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_scope_the_votes_from_today()
    {
        $listing = factory(Listing::class)->create();

        $listing->clicks()->save(factory(Vote::class)->make(['created_at' => Carbon::today()]));

        $listing->clicks()->save(factory(Vote::class)->make(['created_at' => Carbon::yesterday()]));

        $this->assertSame(1, Vote::onPeriod(Carbon::today())->count());
    }

    /**
     * @test
     */
    public function it_can_scope_clicks_between_period()
    {
        $listing = factory(Listing::class)->create();

        $listing->clicks()->save(factory(Click::class)->make(['created_at' => Carbon::today()]));

        $listing->clicks()->save(factory(Click::class)->make(['created_at' => Carbon::yesterday()]));

        $this->assertSame(2, Click::betweenPeriod(Carbon::today(), Carbon::yesterday())->count());
    }

    /**
     * @test
     */
    public function it_has_an_ip_address()
    {
        $listing = factory(Listing::class)->create();

        $listing->clicks()->save(factory(Click::class)->make(['ip_address' => '127.0.0.5', 'created_at' => now()]));

        $this->assertEquals('127.0.0.5', $listing->clicks()->first()->ip_address);
    }

    /**
     * @test
     */
    public function it_can_publish_a_vote_without_requiring_authentication()
    {
        $listing = factory(Listing::class)->create();

        $click = $listing->clicks()->save(new Click);

        $this->assertEquals(null, $click->publisher);
    }

    /**
     * @test
     */
    public function it_has_a_configuration_for_spread()
    {
        $this->assertEquals(1, config('action.click.spread'));
    }
}
