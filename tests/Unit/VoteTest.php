<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Vote;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
