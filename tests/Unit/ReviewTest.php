<?php

namespace Tests\Unit;

use App\User;
use BrianFaust\Reportable\Models\Report;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\ReviewComment;
use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Database\Eloquent\Collection;

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
        $review = factory(Review::class)->create();

        $listing = factory(Listing::class)->create();

        $listing->reviews()->save($review);

        $this->assertInstanceOf(Listing::class, $review->listing);

        $this->assertNotNull($review->publisher->getKey());
    }

    public function test_it_has_a_comment()
    {
        $review = factory(Review::class)->create();

        $review->comments()->save(factory(ReviewComment::class)->make());

        $this->assertCount(1, $review->comments);

        $this->assertInstanceOf(Collection::class, $review->comments);
    }

    /**
     * @test
     */
    public function it_has_a_publisher()
    {
        $review = factory(Review::class)->create();

        $this->assertInstanceOf(User::class, $review->publisher);

        $this->assertNotNull($review->publisher->getKey());
    }

    /**
     * @test
     */
    public function it_can_scope_reviews_from_a_publisher()
    {
        $publisher = factory(User::class)->create();

        factory(Review::class)->create(['publisher_id' => $publisher->id]);

        $this->assertCount(1, Review::publishedBy($publisher)->get());
    }

    /**
     * @test
     */
    public function it_has_a_message()
    {
        $review = factory(Review::class)->create(['message' => 'Gr8 Server']);

        $this->assertEquals('Gr8 Server', $review->message);
    }

    /**
     * @test
     */
    public function it_has_donation_score()
    {
        $review = factory(Review::class)->create(['donation_score' => 6]);

        $this->assertEquals(6, $review->donation_score);
    }

    /**
     * @test
     */
    public function it_has_a_publisher_ip_address()
    {
        $review = factory(Review::class)->create(['ip_address' => '127.0.0.1']);

        $this->assertEquals('127.0.0.1', $review->ip_address);
    }

    /**
     * @test
     */
    public function it_has_update_score()
    {
        $review = factory(Review::class)->create(['update_score' => 3]);

        $this->assertEquals(3, $review->update_score);
    }

    /**
     * @test
     */
    public function it_has_class_score()
    {
        $review = factory(Review::class)->create(['class_score' => 7]);

        $this->assertEquals(7, $review->class_score);
    }

    /**
     * @test
     */
    public function it_has_item_score()
    {
        $review = factory(Review::class)->create(['item_score' => 2]);

        $this->assertEquals(2, $review->item_score);
    }

    /**
     * @test
     */
    public function it_has_support_score()
    {
        $review = factory(Review::class)->create(['support_score' => 6]);

        $this->assertEquals(6, $review->support_score);
    }

    /**
     * @test
     */
    public function it_has_hosting_score()
    {
        $review = factory(Review::class)->create(['hosting_score' => 5]);

        $this->assertEquals(5, $review->hosting_score);
    }

    /**
     * @test
     */
    public function it_has_content_score()
    {
        $review = factory(Review::class)->create(['content_score' => 9]);

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
            ]
        );

        $this->assertEquals(5.8, $review->average_score);
    }

    /**
     * @test
     */
    public function it_has_event_score()
    {
        $review = factory(Review::class)->create(['event_score' => 10]);

        $this->assertEquals(10, $review->event_score);
    }

    /**
     * @test
     */
    public function it_can_get_the_latest_reviews()
    {
        factory(Review::class)->create(['created_at' => Carbon::today()]);

        factory(Review::class)->create(['created_at' => Carbon::yesterday()]);

        $collection = Review::latest()->take(2)->get();

        $this->assertCount(2, $collection);

        $this->assertEquals(Carbon::today(), $collection->shift()->created_at);
    }

    public function test_review_can_be_reported()
    {
        $user = factory(User::class)->create();

        $review = factory(Review::class)->create();

        $review->report([
            'reason' => $this->faker->paragraph,
            'meta' => ['some more optional data, can be notes or something'],
        ], $user);

        $this->assertCount(1, $review->reports);
    }
}
