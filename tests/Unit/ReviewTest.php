<?php

namespace Tests\Unit;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use App\ReviewComment;
use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ReviewTest.
 */
class ReviewTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_belongs_to_a_listing()
    {
        /** @var Review $review */
        $listing = factory(Listing::class)->create();

        $review = $listing->reviews()->save(factory(Review::class)->create(
            [
                'listing_id' => $listing->id,
                'user_id' => factory(User::class)->create()->id
            ]
        ));

        $this->assertInstanceOf(Listing::class, $review->listing);

        $this->assertNotNull($review->user->getKey());
    }

    public function test_it_has_a_comment()
    {
        $review = factory(Review::class)->create(
            [
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id
            ]
        );

        $review->comments()->save(factory(ReviewComment::class)->make());

        $this->assertCount(1, $review->comments);

        $this->assertInstanceOf(Collection::class, $review->comments);
    }

    /**
     * @test
     */
    public function it_has_a_publisher()
    {
        $review = factory(Review::class)->create(
            [
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id
            ]
        );

        $this->assertInstanceOf(User::class, $review->user);

        $this->assertNotNull($review->user->getKey());
    }

    /**
     * @test
     */
    public function it_can_scope_reviews_from_a_publisher()
    {
        $publisher = factory(User::class)->create();

        factory(Review::class)->create([
            'user_id' => $publisher->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertCount(1, Review::publishedBy($publisher)->get());
    }

    /**
     * @test
     */
    public function it_has_a_message()
    {
        $review = factory(Review::class)->create([
            'message' => 'Gr8 Server',
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals('Gr8 Server', $review->message);
    }

    /**
     * @test
     */
    public function it_has_donation_score()
    {
        $review = factory(Review::class)->create([
            'donation_score' => 6,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(6, $review->donation_score);
    }

    /**
     * @test
     */
    public function it_has_a_publisher_ip_address()
    {
        $review = factory(Review::class)->create([
            'ip_address' => '127.0.0.1',
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals('127.0.0.1', $review->ip_address);
    }

    /**
     * @test
     */
    public function it_has_update_score()
    {
        $review = factory(Review::class)->create([
            'update_score' => 3,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(3, $review->update_score);
    }

    /**
     * @test
     */
    public function it_has_class_score()
    {
        $review = factory(Review::class)->create([
            'class_score' => 7,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(7, $review->class_score);
    }

    /**
     * @test
     */
    public function it_has_item_score()
    {
        $review = factory(Review::class)->create([
            'item_score' => 2,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(2, $review->item_score);
    }

    /**
     * @test
     */
    public function it_has_support_score()
    {
        $review = factory(Review::class)->create([
            'support_score' => 6,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(6, $review->support_score);
    }

    /**
     * @test
     */
    public function it_has_hosting_score()
    {
        $review = factory(Review::class)->create([
            'hosting_score' => 5,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(5, $review->hosting_score);
    }

    /**
     * @test
     */
    public function it_has_content_score()
    {
        $review = factory(Review::class)->create([
            'content_score' => 9,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(9, $review->content_score);
    }

    /**
     * @test
     */
    public function it_has_an_average_score()
    {
        /** @var Review $review */
        $review = factory(Review::class)->create(
            [
                'donation_score' => 8,
                'update_score' => 4,
                'class_score' => 10,
                'item_score' => 9,
                'support_score' => 10,
                'hosting_score' => 2,
                'content_score' => 2,
                'event_score' => 1,
                'user_id' => factory(User::class)->create()->id,
                'listing_id' => factory(Listing::class)->create()->id
            ]
        );

        $this->assertEquals(5.8, $review->average_score);
    }

    /**
     * @test
     */
    public function it_has_event_score()
    {
        $review = factory(Review::class)->create([
            'event_score' => 10,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(10, $review->event_score);
    }

    /**
     * @test
     */
    public function it_can_get_the_latest_reviews()
    {
        factory(Review::class)->create([
            'created_at' => Carbon::today(),
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        factory(Review::class)->create([
            'created_at' => Carbon::yesterday(),
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $collection = Review::latest()->take(2)->get();

        $this->assertCount(2, $collection);

        $this->assertEquals(Carbon::today(), $collection->shift()->created_at);
    }

    public function test_review_can_be_reported()
    {
        $user = factory(User::class)->create();

        $review = factory(Review::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $review->report([
            'reason' => $this->faker->paragraph,
            'meta' => ['some more optional data, can be notes or something'],
        ], $user);

        $this->assertCount(1, $review->reports);
    }

    public function test_review_generates_average_when_being_created()
    {
        $review = factory(Review::class)->create([
            'donation_score' => 3,
            'update_score' => 5,
            'class_score' => 1,
            'item_score' => 5,
            'support_score' => 1,
            'hosting_score' => 1,
            'content_score' => 5,
            'event_score' => 4,
            'user_id' => factory(User::class)->create()->id,
            'listing_id' => factory(Listing::class)->create()->id
        ]);

        $this->assertEquals(3.1, $review->average_score);
    }
}
