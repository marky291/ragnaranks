<?php

namespace Tests\Unit;

use App\Click;
use App\Listings\Listing;
use App\Vote;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingContainerTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_pull_listings_from_the_container()
    {
        factory(Listing::class, 5)->create();

        $servers = app('listings');

        $this->assertCount(5, $servers);
    }

    /**
     * @test
     */
    public function it_returns_listings_with_a_rank()
    {
        $listing = factory(Listing::class)->create();

        $listing->votes()->saveMany(factory(Vote::class, 5)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing->clicks()->saveMany(factory(Click::class, 3)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing = app('listings')->first();

        $this->assertEquals(1,  $listing->rank);

        $this->assertEquals(5, $listing->votes_count);

        $this->assertEquals(3, $listing->clicks_count);
    }

    /**
     * @test
     */
    public function it_ranks_and_sorts_listings_based_on_clicks_and_votes()
    {
        $listing1 = factory(Listing::class)->create();

        $listing1->votes()->saveMany(factory(Vote::class, 1)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing1->clicks()->saveMany(factory(Click::class, 2)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing2 = factory(Listing::class)->create();

        $listing2->votes()->saveMany(factory(Vote::class, 3)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing2->clicks()->saveMany(factory(Click::class, 5)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listings = app('listings');

        $this->assertSame($listings->first()->name, $listing2->name);

    }
}
