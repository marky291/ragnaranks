<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Reviews\Review;
use App\Listings\Listing;
use App\Notifications\ReportedReviewAllowed;
use App\Notifications\ReportedReviewRemoved;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_required()
    {
        $response = $this->get('/moderate/report');

        $response->assertStatus(302);
    }

    public function test_index()
    {
        $this->signIn();

        $response = $this->get('/moderate/report');

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->signIn();

        Notification::fake();

        $review = factory(Review::class)->create(
            ['listing_id' => factory(Listing::class)->create()->id]
        );

        $review->report(['reason' => 'foo'], auth()->user());

        $response = $this->patch("/moderate/report/{$review->reports->first()->getKey()}");

        $response->assertStatus(200);

        Notification::assertSentTo(auth()->user(), ReportedReviewAllowed::class);
    }

    public function test_destroy()
    {
        $this->signIn();

        Notification::fake();

        $review = factory(Review::class)->create(
            ['listing_id' => factory(Listing::class)->create()->id]
        );

        $review->report(['reason' => 'foo'], auth()->user());

        $response = $this->delete("/moderate/report/{$review->reports->first()->getKey()}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);

        Notification::assertSentTo(auth()->user(), ReportedReviewRemoved::class);
    }
}
