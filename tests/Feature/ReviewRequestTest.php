<?php

namespace Tests\Feature;

use App\Listings\Listing;
use App\Review;
use const Grpc\STATUS_OK;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewRequestTest extends TestCase
{
    /**
     * @test
     */
    public function a_review_can_be_added()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $review = factory(Review::class)->make(['message' => "A sample review data message."]);

        $this->post("/listing/listing-name/reviews", $review->toArray());

        $this->assertCount(1, $listing->reviews);

        $this->assertCount(1, Auth::user()->reviews);
    }

    /**
     * @test
     */
    public function a_review_form_invalidates_required_attributes()
    {
        $this->withExceptionHandling();

        $this->createListing(['slug' => 'listing-name'], 0,0);

        $this->post("/listing/listing-name/reviews", [])->assertSessionHasErrors(
            [
                'message',
                'donation_score',
                'update_score',
                'class_score',
                'item_score',
                'support_score',
                'hosting_score',
                'content_score',
                'event_score'
            ]);
    }

    /**
     * @test
     */
    public function a_review_form_invalidates_scores_above_10()
    {
        $this->createListing(['slug' => 'listing-name'], 0,0);

        $review = factory(Review::class)->make(['donation_score' => 15]);

        $this->post("/listing/listing-name/reviews", $review->toArray())->assertSessionHasErrors(['donation_score']);
    }

    /**
     * @test
     */
    public function a_review_form_invalidates_scores_below_0()
    {
        $this->createListing(['slug' => 'listing-name'], 0,0);

        $review = factory(Review::class)->make(['donation_score' => -5]);

        $this->post("/listing/listing-name/reviews", $review->toArray())->assertSessionHasErrors(['donation_score']);
    }

    /**
     * @test
     */
    public function a_review_form_invalidates_scores_that_are_not_integer()
    {
        $this->createListing(['slug' => 'listing-name'], 0,0);

        $review = factory(Review::class)->make(['donation_score' => "foo"]);

        $this->post("/listing/listing-name/reviews", $review->toArray())->assertSessionHasErrors(['donation_score']);
    }
}
