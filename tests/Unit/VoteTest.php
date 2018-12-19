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
    public function it_can_scope_the_votes_to_the_current_week()
    {
        /** @var \App\Listings\Listing $server */
        $server = factory(Listing::class)->create();

        $server->votes()->saveMany([
            factory(Vote::class)->create(['created_at' => Carbon::now()->startOfYear()]),
            factory(Vote::class)->create(['created_at' => Carbon::now()->startOfDay()])
        ]);

        $this->assertCount(1, $server->votes()->thisWeek()->get());
    }
}
