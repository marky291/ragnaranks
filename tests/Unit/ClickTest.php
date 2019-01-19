<?php

namespace Tests\Unit;

use App\Interactions\Click;
use App\Listings\Listing;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClickTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_scope_the_votes_from_today()
    {
        factory(Click::class)->create(['created_at' => Carbon::today()]);

        factory(Click::class)->create(['created_at' => Carbon::yesterday()]);

        $this->assertSame(1, Click::onPeriod(Carbon::today())->count());
    }

    /**
     * @test
     */
    public function it_can_scope_votes_between_period()
    {
        factory(Click::class)->create(['created_at' => Carbon::today()]);

        factory(Click::class)->create(['created_at' => Carbon::yesterday()]);

        $this->assertSame(2, Click::betweenPeriod(Carbon::today(), Carbon::yesterday())->count());
    }

    /**
     * @test
     */
    public function it_has_an_ip_address()
    {
        $vote = factory(Click::class)->create(['ip_address' => '127.0.0.5']);

        $this->assertEquals('127.0.0.5', $vote->ip_address);
    }

    /**
     * @test
     */
    public function it_has_a_publisher_only_if_auth_logged_in()
    {
        $this->signIn();

        $listing = factory(Listing::class)->create();

        $click = $listing->clicks()->save(new Click);

        $this->assertEquals(auth()->id(), $click->publisher->id);
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
    public function it_stores_the_ip_address_using_observer_when_saved()
    {
        $this->assertEquals(request()->getClientIp(), Click::create()->ip_address);
    }
}
