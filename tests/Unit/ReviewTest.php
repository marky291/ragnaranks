<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Review;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ReviewTest
 *
 * @package Tests\Unit
 */
class ReviewTest extends TestCase
{
    /**
     * @test
     */
    public function it_belongs_to_a_listing()
    {
        $review = factory(Review::class)->create();

        $this->assertInstanceOf(Listing::class, $review->listing);

        $this->assertNotNull($review->publisher->getKey());
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
    public function it_has_a_message()
    {
        $review = factory(Review::class)->create(['message' => "Gr8 Server"]);

        $this->assertEquals("Gr8 Server", $review->message);
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
}
