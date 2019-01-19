<?php

namespace Tests\Unit;

use App\Interactions\Click;
use App\Listings\AddListingToContainer;
use App\Listings\CacheListingsContainer;
use App\Listings\Listing;
use App\Interactions\Vote;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ListingContainerTest
 *
 * @package Tests\Unit
 */
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

    /**
     * @test
     */
    public function it_builds_the_cache_when_no_cache_exists()
    {
        $this->expectsJobs(CacheListingsContainer::class);

        factory(Listing::class, 5)->create();

        app('listings');
    }

    /**
     * @test
     */
    public function it_calls_a_job_when_a_listing_is_added()
    {
        $this->app->make('listings');

        $this->expectsJobs(AddListingToContainer::class);

        $this->createListing([], 5, 5);
    }

    /**
     * @test
     */
    public function it_adds_the_new_listing_to_the_cache_container()
    {
        $this->app->make('listings');

        $this->createListing([], 5, 5);

        $this->assertCount(1, $this->app->make('listings'));
    }

   /**
    * @test
    */
   public function it_returns_all_listings_created_by_a_user()
   {
       $this->signIn();

       $this->createListing(['user_id' => auth()->user()], 5, 7);

       $this->createListing(['user_id' => auth()->user()], 3, 14);

       $listings = $this->app->make('listings')->filterOwner(auth()->user());

       $this->assertCount(2, $listings);
   }

    /**
     * @test
     */
    public function it_returns_a_single_listing_from_the_container()
    {
        factory(Listing::class, 3)->create();

        $needle = $this->createListing([], 0, 0);

        $listing = app('listings')->where('id', $needle->id)->first();

        $this->assertSame($needle->id, $listing->id);
    }
}
