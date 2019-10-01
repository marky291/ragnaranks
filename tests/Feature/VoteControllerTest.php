<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Listings\Listing;
use App\Interactions\Vote;
use App\Listings\ListingVotedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_will_not_authorize_more_than_one_vote_every_six_hours()
    {
        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $listing->votes()->save(factory(Vote::class)->make(['created_at' => now()->subHours(5), 'ip_address' => '127.0.0.1']));

        $this->post('/listing/listing-name/votes', [], ['REMOTE_ADDR' => '127.0.0.1']);

        $this->assertCount(1, $listing->votes);
    }

    /**
     * @test
     */
    public function it_can_store_a_new_vote()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $this->post('/listing/foo/votes')->assertOk();

        $this->assertCount(1, $listing->votes);

        $this->assertDatabaseHas('votes', ['ip_address' => '127.0.0.1']);
    }

    public function test_it_can_process_an_automatic_vote()
    {
        $this->withoutExceptionHandling();

        /** @var User $user */
        $user = $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'listing']);

        $response = $this->get("/api/listing/vote4points?api_token={$user->api_token}");

        $this->assertDatabaseHas('votes', ['ip_address' => '127.0.0.1']);
    }

    /**
     * @test
     */
    public function it_dispatches_vote_completed_event()
    {
        $this->withoutExceptionHandling();

        Event::fake();

        $this->signIn();

        factory(Listing::class)->create(['slug' => 'foo']);

        $this->post('/listing/foo/votes');

        Event::assertDispatched(ListingVotedEvent::class);
    }

    public function test_casting_vote_repositions_rank()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing1 = factory(Listing::class)->create(['id' => 5, 'name' => 'foo']);
        $listing2 = factory(Listing::class)->create(['id' => 20, 'name' => 'bar']);

        $this->assertEquals(1, $listing1->ranking->rank);
        $this->assertEquals(2, $listing2->ranking->rank);

        $this->post('/listing/bar/votes');

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 20, 'rank' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 5, 'rank' => 2]);
    }
}
