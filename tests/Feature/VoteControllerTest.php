<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\Votes\Vote;
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

        $this->post(route('listing.clicks.store', $listing))->assertOk();

        $this->assertCount(1, $listing->clicks);

        $this->assertDatabaseHas('clicks', ['ip_address' => '127.0.0.1']);
    }

    public function test_it_can_process_an_automatic_vote()
    {
        /** @var User $user */
        $user = $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $this->get(route('vote4points', ['listing' => $listing, 'api_token' => $user->api_token]));

        $this->assertDatabaseHas('votes', ['ip_address' => '127.0.0.1']);
    }

    /**
     * @test
     */
    public function it_dispatches_vote_completed_event()
    {
        $this->signIn();

        $event = Event::fake();

        $listing = factory(Listing::class)->create(['slug' => 'foo']);

        $this->post(route('listing.votes.store', $listing));

        $event->assertDispatched(ListingVotedEvent::class);
    }

    public function test_casting_vote_repositions_rank()
    {
        $this->signIn();

        $listing1 = factory(Listing::class)->create(['name' => 'foo']);
        $listing2 = factory(Listing::class)->create(['name' => 'bar']);

        $this->assertEquals(1, $listing1->ranking->rank);
        $this->assertEquals(2, $listing2->ranking->rank);

        $this->post(route('listing.votes.store', $listing2));

        $this->assertDatabaseHas('listing_rankings', ['id' => $listing2->id, 'rank' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['id' => $listing1->id, 'rank' => 2]);
    }
}
