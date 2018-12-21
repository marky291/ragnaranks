<?php

namespace Tests\Unit;

use App\Click;
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
}
