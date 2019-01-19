<?php

namespace Tests\Feature;

use App\Interactions\Vote;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_not_authorize_more_than_one_vote_every_six_hours()
    {
        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $listing->votes()->save(factory(Vote::class)->create(['created_at' => now()->subHours(5), 'ip_address' => '127.0.0.1']));

        $this->post("/listing/listing-name/votes", [], ['REMOTE_ADDR' => '127.0.0.1']);

        $this->assertCount(1, $listing->votes);
    }

    /**
     * @test
     */
    public function it_can_store_a_new_vote()
    {
        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $this->post("/listing/listing-name/votes", [], ['REMOTE_ADDR' => '10.1.0.1'])->assertOk();

        $this->assertCount(1, $listing->votes);

        $this->assertDatabaseHas('votes', ['ip_address' => '10.1.0.1']);
    }
}
