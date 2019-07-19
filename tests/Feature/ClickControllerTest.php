<?php

namespace Tests\Feature;

use App\Listings\ListingClickedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Listings\Listing;
use App\Interactions\Click;

class ClickControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_not_count_more_than_one_click_per_hour_from_ip_address()
    {
        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $listing->clicks()->save(new Click);

        $this->post('/listing/listing-name/clicks', [], ['REMOTE_ADDR' => '127.0.0.1']);

        $this->assertCount(1, $listing->clicks);
    }

    /**
     * @test
     */
    public function it_can_store_a_new_click()
    {
        $this->withoutExceptionHandling();

        $ip_address = '127.0.0.5';

        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $this->post('/listing/listing-name/clicks', [], ['REMOTE_ADDR' => $ip_address]);

        $this->assertCount(1, $listing->clicks);

        $this->assertDatabaseHas('clicks', ['ip_address' => $ip_address]);
    }

    /**
     * @test
     */
    public function it_redirects_to_the_listing_website_after_being_clicked()
    {
        $listing = factory(Listing::class)->create(['website' => 'http://foo.com']);

        $response = $this->post("/listing/{$listing->slug}/clicks");

        $response->assertJson(['success' => true]);
    }

    /**
     * @test
     */
    public function it_dispatches_click_completed_event()
    {
        $this->withoutExceptionHandling();

        Event::fake();

        factory(Listing::class)->create(['slug' => 'foo']);

        $this->post('/listing/foo/clicks');

        Event::assertDispatched(ListingClickedEvent::class);
    }
}
