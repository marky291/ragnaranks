<?php

namespace Tests\Feature;

use App\Listings\ListingConfiguration;
use Tests\TestCase;
use App\Listings\Listing;
use App\Reviews\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewControllerTest extends TestCase
{
    use WithFaker;

    use RefreshDatabase;

    public function test_review_index_returns_200()
    {
        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $listing->configuration()->save(factory(ListingConfiguration::class)->make());

        $response = $this->get(route('listing.reviews.index', $listing));

        $response->assertStatus(200);
    }

    public function test_create_review_form_requires_login_and_returns_200()
    {
        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $listing->configuration()->save(factory(ListingConfiguration::class)->make());

        $this->get(route('listing.reviews.create', $listing))->assertStatus(302);

        $this->signIn();

        $this->get(route('listing.reviews.create', $listing))->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_review_can_be_added()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $review = factory(Review::class)->make(['message' => $this->faker->sentence(300)]);

        $this->post('/listing/foo/reviews', $review->toArray());

        $this->assertCount(1, $listing->reviews);

        $this->assertCount(1, Auth::user()->reviews);
    }

    /**
     * @test
     */
    public function a_review_can_be_destroyed()
    {
        $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $listing->reviews()->save(factory(Review::class)->create(
            ['listing_id' => factory(Listing::class)->create()->id]
        ));

        $this->delete("/listing/{$listing->slug}/reviews/{$listing->reviews()->first()->id}");

        $this->assertCount(0, $listing->reviews);
    }

    public function test_a_review_can_be_updated()
    {
        $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $review = $listing->reviews()->save(factory(Review::class)->make());

        $updateReview = factory(Review::class)->make();

        $this->patch(route('listing.reviews.update', [$listing, $review]), $updateReview->toArray());

        $this->assertDatabaseHas('reviews', ['id' => $listing->reviews()->first()->getkey(), 'message' => $updateReview->message]);
    }

    /**
     * @test
     */
    public function it_can_be_destroyed()
    {
        $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $review = $listing->reviews()->save(factory(Review::class)->make());

        $this->delete("/listing/{$listing->slug}/reviews/{$review->getKey()}");

        $this->assertDatabaseMissing('reviews', ['id' => $review->getKey()]);
    }

    /**
     *
     */
    public function test_it_can_be_reported()
    {
        $this->markTestSkipped('Feature Disabled');

        $this->signIn();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $review = $listing->reviews()->save(factory(Review::class)->make());

        $listing = factory(Listing::class)->create();

        $listing->reviews()->save($review);

        $response = $this->post(route('review.report.store', $review), ['reason' => 'foo', 'meta' => 'bar']);

        $response->assertStatus(200);

        $this->assertCount(1, $review->reports);
    }

    public function test_a_review_cannot_be_created_twice_by_same_user_on_listing()
    {
        $this->signIn();

        $listing = factory(Listing::class)->create();
        $review1 = factory(Review::class)->make(['content_score' => 5]);
        $review2 = factory(Review::class)->make(['content_score' => 1]);

        $response1 = $this->post("/listing/{$listing->slug}/reviews", $review1->toArray());
        $response2 = $this->post("/listing/{$listing->slug}/reviews", $review2->toArray());

        $this->assertDatabaseHas('reviews', ['content_score' => 5]);
        $this->assertDatabaseMissing('reviews', ['content_score' => 1]);
    }
}
