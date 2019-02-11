<?php

namespace Tests\Unit;

use App\Interactions\Click;
use App\Interactions\Vote;
use App\Listings\Listing;
use App\Interactions\Review;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Mockery\Mock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ListingTest
 *
 * @package Tests\Unit
 */
class ListingTest extends TestCase
{
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
        $server = factory(Listing::class)->create();

        $this->assertNotNull($server->mode->name);
    }

    /**
     * @test
     */
    public function it_has_a_config()
    {
        $server = factory(Listing::class)->create();

        $this->assertNotNull($server->configs);
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
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->saveMany(factory(Review::class, 3)->create());

        $this->assertCount(3, $listing->reviews);
    }

    /**
     * @test
     */
    public function it_has_a_vote_interaction()
    {
        $server = factory(Listing::class)->create();

        $vote = factory(Vote::class)->create();

        $server->votes()->save($vote);

        $this->assertCount(1, $server->votes);
    }

    /**
     * @test
     */
    public function it_has_a_click_interaction()
    {
        $server = factory(Listing::class)->create();

        $click = factory(Click::class)->create();

        $server->clicks()->save($click);

        $this->assertCount(1, $server->clicks);
    }

    /**
     * @test
     */
    public function it_can_have_a_low_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.low-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('Low Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_mid_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.mid-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('Mid Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.high-rate.max') * 0.9;

        $listing->configs = $array;

        $this->assertEquals('High Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_can_have_a_super_high_rate_exp_title()
    {
        $listing = factory(Listing::class)->create();

        $array = $listing->configs;

        $array['base_exp_rate'] = config('filter.exp.high-rate.max') + 1;

        $listing->configs = $array;

        $this->assertEquals('Super High Rate', $listing->expRateTitle);
    }

    /**
     * @test
     */
    public function it_gains_1_point_for_every_seven_clicks()
    {
        $listing = factory(Listing::class)->create();

        $listing->clicks()->saveMany(factory(Click::class, 7)->create());

        $this->assertEquals(1, $listing->points);
    }

    /**
     * @test
     */
    public function it_gains_1_point_for_every_vote()
    {
        $listing = factory(Listing::class)->create();

        $listing->votes()->saveMany(factory(Vote::class, 1)->create());

        $this->assertEquals(1, $listing->points);
    }

    /**
     * @test
     */
    public function it_can_calculate_points_from_votes_and_clicks()
    {
        $listing = $this->createListing([], 9, 7);

        $this->assertEquals(10, $listing->points);
    }

    /**
     * @test
     */
    public function it_can_create_slugs_if_none_specified()
    {
        $listing = $this->createListing(['name' => 'PHP Unit', 'slug' => null], 0,0);

        $this->assertEquals("php-unit", $listing->slug);
    }

    /**
     * @test
     */
    public function it_has_a_rating_based_on_avg_review_scores()
    {
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['donation_score' => 10, 'update_score' => 10, 'class_score' => 10, 'item_score' => 10, 'support_score' => 10, 'hosting_score' => 10, 'content_score' => 10, 'event_score' => 10]));

        $this->assertEquals(5, $listing->rating);
    }

    /**
     * @test
     */
    public function it_can_get_average_review_donation_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['donation_score' => 0]));
        $listing->reviews()->save(factory(Review::class)->create(['donation_score' => 10]));

        $this->assertEquals(5.0, $listing->reviews()->average('donation_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_update_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['update_score' => 2]));
        $listing->reviews()->save(factory(Review::class)->create(['update_score' => 5]));

        $this->assertEquals(3.5, $listing->reviews()->average('update_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_class_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['class_score' => 7]));
        $listing->reviews()->save(factory(Review::class)->create(['class_score' => 8]));

        $this->assertEquals(7.5, $listing->reviews()->average('class_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_item_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['item_score' => 9]));
        $listing->reviews()->save(factory(Review::class)->create(['item_score' => 3]));

        $this->assertEquals(6.0, $listing->reviews()->average('item_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_support_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['support_score' => 8]));
        $listing->reviews()->save(factory(Review::class)->create(['support_score' => 8]));

        $this->assertEquals(8.0, $listing->reviews()->average('support_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_hosting_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['hosting_score' => 8]));
        $listing->reviews()->save(factory(Review::class)->create(['hosting_score' => 8]));

        $this->assertEquals(8.0, $listing->reviews()->average('hosting_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_content_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['content_score' => 2]));
        $listing->reviews()->save(factory(Review::class)->create(['content_score' => 1]));

        $this->assertEquals(1.5, $listing->reviews()->average('content_score'));
    }

    /**
     * @test
     */
    public function it_can_get_average_review_event_scores()
    {
        /** @var Listing $listing */
        $listing = $this->createListing([], 0,0);

        $listing->reviews()->save(factory(Review::class)->create(['event_score' => 9]));
        $listing->reviews()->save(factory(Review::class)->create(['event_score' => 2]));

        $this->assertEquals(5.5, $listing->reviews()->average('event_score'));
    }

    /**
     * @test
     */
    public function it_can_verify_the_ip_address_has_not_interacted_with_vote()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        $status = $listing->votes()->hasClientInteractedWith(1);

        $this->assertFalse($status);
    }

    /**
     * @test
     */
    public function it_can_verify_the_ip_address_has_interacted_with_vote()
    {
        $listing = factory(Listing::class)->create();

        $listing->votes()->save(new Vote);

        $status = $listing->votes()->hasClientInteractedWith(1);

        $this->assertTrue($status);
    }
}
