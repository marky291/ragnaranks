<?php

namespace Tests\Unit;

use App\Interactions\Review;
use App\Listings\Listing;
use App\ReviewComment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_cannot_store_duplicate_comments_from_the_server_owner()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create();

        $review = $listing->reviews()->save(factory(Review::class)->make());

        $comment1 = factory(ReviewComment::class)->make();
        $comment2 = factory(ReviewComment::class)->make();

        $response = $this->post("review/{$review->getKey()}/comment", $comment1->toArray());
        $response = $this->post("review/{$review->getKey()}/comment", $comment2->toArray());

        $this->assertDatabaseHas('review_comments', ['message' => $comment1->message]);
        $this->assertDatabaseMissing('review_comments', ['message' => $comment2->message]);

    }
}
