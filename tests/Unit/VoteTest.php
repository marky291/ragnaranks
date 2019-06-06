<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Listings\Listing;
use App\Interactions\Vote;

class VoteTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_scope_the_votes_from_today()
    {
        factory(Vote::class)->create(['created_at' => Carbon::today()]);

        factory(Vote::class)->create(['created_at' => Carbon::yesterday()]);

        $this->assertSame(1, Vote::onPeriod(Carbon::today())->count());
    }

    /**
     * @test
     */
    public function it_can_scope_votes_between_period()
    {
        factory(Vote::class)->create(['created_at' => Carbon::today()]);

        factory(Vote::class)->create(['created_at' => Carbon::yesterday()]);

        $this->assertSame(2, Vote::betweenPeriod(Carbon::today(), Carbon::yesterday())->count());
    }

    /**
     * @test
     */
    public function it_has_an_ip_address()
    {
        $vote = factory(Vote::class)->create(['ip_address' => '127.0.0.5']);

        $this->assertEquals('127.0.0.5', $vote->ip_address);
    }

    /**
     * @test
     */
    public function it_has_a_configuration_for_spread()
    {
        $this->assertEquals(6, config('interaction.vote.spread'));
    }
}
