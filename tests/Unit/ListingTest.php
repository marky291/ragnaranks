<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use App\Reviews\Review;
use App\Listings\Listing;
use App\Interactions\Vote;
use App\Interactions\Click;
use App\Listings\ListingScreenshot;
use App\Listings\ListingConfiguration;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ListingTest.
 */
class ListingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_a_route_key_name()
    {
        $this->assertEquals('slug', (new Listing)->getRouteKeyName());
    }

    /**
     * @test
     */
    public function it_has_a_mode()
    {
        /** @var Listing $server */
        $server = factory(Listing::class)->create(['mode' => 'foo']);

        $this->assertEquals('foo', $server->mode);
    }

    /**
     * @test
     */
    public function it_has_an_owner()
    {
        $this->signIn();

        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['user_id' => auth()->id()]);

        $this->assertSame(auth()->id(), $listing->user->id);
    }

    /**
     * @test
     */
    public function it_has_tags()
    {
        $server = factory(Listing::class)->create();

        $server->tags()->save(Tag::all()->random());

        $this->assertCount(1, $server->tags);
    }

    /**
     * @test
     */
    public function it_has_reviews()
    {
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->saveMany(factory(Review::class, 1)->make(
            [
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));


        $this->assertCount(1, $listing->reviews);
    }

    public function test_it_has_review_score()
    {
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->make([
            'donation_score' => 3,
            'update_score' => 5,
            'class_score' => 1,
            'item_score' => 5,
            'support_score' => 1,
            'hosting_score' => 1,
            'content_score' => 5,
            'event_score' => 4,
            'user_id' => factory(User::class)->create()->id,
        ]));

        $this->assertEquals(3.1, Review::first()->average_score);
    }

    public function test_it_has_a_default_review_score()
    {
        $listing = $this->createListing([], 0, 0);

        $this->assertEquals(0, $listing->review_score);
    }

    /**
     * @test
     */
    public function it_has_a_vote_interaction()
    {
        $server = factory(Listing::class)->create();

        $server->votes()->save(factory(Vote::class)->make(['created_at' => now()]));

        $this->assertCount(1, $server->votes);
    }

    /**
     * @test
     */
    public function it_has_a_click_interaction()
    {
        $listing = factory(Listing::class)->create();

        $click = $listing->clicks()->save(factory(Click::class)->make(['created_at' => Carbon::now()->subDay()]));

        $this->assertCount(1, $listing->clicks);
    }

    /**
     * @test
     */
    public function it_can_have_a_low_rate_exp_title()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make(['base_exp_rate' => config('filter.exp.low-rate.max') * 0.9]));

        $this->assertEquals('low-rate', $listing->configuration->exp_title);
    }

    /**
     * @test
     */
    public function it_can_have_a_mid_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make(['base_exp_rate' => config('filter.exp.mid-rate.max') * 0.9]));

        $this->assertEquals('mid-rate', $listing->configuration->exp_title);
    }

    /**
     * @test
     */
    public function it_can_have_a_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make(['base_exp_rate' => config('filter.exp.high-rate.max') * 0.9]));

        $this->assertEquals('high-rate', $listing->configuration->exp_title);
    }

    /**
     * @test
     */
    public function it_can_have_a_super_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make(['base_exp_rate' => config('filter.exp.high-rate.max') + 1]));

        $this->assertEquals('super-high-rate', $listing->configuration->exp_title);
    }

    /**
     * @test
     */
    public function it_gains_1_point_for_every_seven_clicks()
    {
        $listing = factory(Listing::class)->create();

        $listing->clicks()->saveMany(factory(Click::class, 7)->make(['created_at' => Carbon::now()]));

        $this->assertCount(7, $listing->clicks);
    }

    /**
     * @test
     */
    public function it_gains_1_point_for_every_vote()
    {
        $listing = factory(Listing::class)->create();

        $listing->votes()->saveMany(factory(Vote::class, 1)->make(['created_at' => Carbon::now()]));

        $this->assertCount(1, $listing->votes);
    }

    /**
     * @test
     */
    public function it_can_calculate_points_from_votes_and_clicks()
    {
        $listing = $this->createListing([], 9, 7);

        $this->assertEquals(70, $listing->points);
    }

    /**
     * @test
     */
    public function it_can_create_slugs_if_none_specified()
    {
        $listing = $this->createListing(['name' => 'PHP Unit', 'slug' => null], 0, 0);

        $this->assertEquals('php-unit', $listing->slug);
    }

    /**
     * @test
     */
    public function it_can_get_average_review_donation_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'donation_score' => 0,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'donation_score' => 10,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(5.0, $listing->reviews()->average('donation_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_update_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'update_score' => 2,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));
        $listing->reviews()->save(factory(Review::class)->create(
            [
                'update_score' => 5,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(3.5, $listing->reviews()->average('update_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_class_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'class_score' => 7,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => $listing->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'class_score' => 8,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => $listing->id,
            ]
        ));

        $this->assertEquals(7.5, $listing->reviews()->average('class_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_item_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'item_score' => 9,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'item_score' => 3,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(6.0, $listing->reviews()->average('item_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_support_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'support_score' => 8,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'support_score' => 8,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(8.0, $listing->reviews()->average('support_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_hosting_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'hosting_score' => 8,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'hosting_score' => 8,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(8.0, $listing->reviews()->average('hosting_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_content_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'content_score' => 2,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'content_score' => 1,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(1.5, $listing->reviews()->average('content_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_event_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0, 0);

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'event_score' => 9,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $listing->reviews()->save(factory(Review::class)->create(
            [
                'event_score' => 2,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id,
            ]
        ));

        $this->assertEquals(5.5, $listing->reviews()->average('event_score'));
    }

    /**
     * @test
     */
    public function it_can_verify_the_ip_address_has_not_interacted_with_vote()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        $status = $listing->votes()->hasInteractedDuring(1);

        $this->assertFalse($status);
    }

    /**
     * @test
     */
    public function it_can_verify_the_ip_address_has_interacted_with_vote()
    {
        $listing = factory(Listing::class)->create();

        $listing->votes()->save(new Vote);

        $status = $listing->votes()->hasInteractedDuring(1);

        $this->assertTrue($status);
    }

    public function test_it_can_have_screenshots()
    {
        $listing = factory(Listing::class)->create();

        $listing->screenshots()->save(factory(ListingScreenshot::class)->make());

        $this->assertCount(1, $listing->screenshots);

        $this->assertDatabaseHas('listing_screenshots', ['listing_id' => $listing->id]);
    }

    public function test_it_has_the_default_accent_color()
    {
        $listing = factory(Listing::class)->create();

        $this->assertDatabaseHas('listings', ['id' => $listing->id, 'accent' => 'nightmare']);
    }

    public function test_it_has_a_language()
    {
        $listing = factory(Listing::class)->create(['language_id' => 1]);

        $this->assertEquals('english', $listing->language->name);
    }

    public function test_has_a_config_relationship()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make());

        $this->assertInstanceOf(ListingConfiguration::class, $listing->configuration);
    }

    public function test_a_ranking_is_generated_when_a_listing_is_created()
    {
        $listing = factory(Listing::class)->create();

        $this->assertNotNull($listing->ranking);

        $this->assertDatabaseHas('listing_rankings', ['rank' => 1, 'votes' => 0, 'clicks' => 0]);
    }

    public function test_a_listing_can_be_soft_deleted()
    {
        $listing = factory(Listing::class)->create();

        $action = $listing->delete();

        $this->assertDatabaseHas('listings', ['deleted_at' => now(), 'id' => $listing->id]);
    }

    public function test_it_has_no_heartbeat()
    {
        $listing = factory(Listing::class)->create();

        $this->assertNull($listing->heartbeat);
    }

    public function test_it_has_a_heartbeat()
    {
        $listing = factory(Listing::class)->create();

        $listing->heartbeats()->save(new \App\Listings\ListingHeartbeat(['informer' => 'foo']));

        $this->assertInstanceOf(\App\Listings\ListingHeartbeat::class, $listing->heartbeat);
    }

    public function test_it_has_gets_latest_heartbeat()
    {
        $listing = factory(Listing::class)->create();

        $listing->heartbeats()->save(new \App\Listings\ListingHeartbeat(['informer' => 'foo']));
        $listing->heartbeats()->save(new \App\Listings\ListingHeartbeat(['informer' => 'bar']));

        $this->assertEquals('bar', $listing->heartbeat->informer);
    }
}
