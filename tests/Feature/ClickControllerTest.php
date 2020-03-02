<?php

namespace Tests\Feature;

use App\Listings\Clicks\WebsiteWasClicked;
use App\Listings\Events\Clicked;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\Clicks\Click;
use Illuminate\Support\Facades\Event;

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

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $this->post('/listing/foo/clicks', [], ['REMOTE_ADDR' => $ip_address]);

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

        $response->assertStatus(200);
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

        Event::assertDispatched(Clicked::class);
    }

    public function test_casting_click_repositions_rank()
    {
        $this->withoutExceptionHandling();

        $listing1 = factory(Listing::class)->create(['id' => 5, 'name' => 'foo']);
        $listing2 = factory(Listing::class)->create(['id' => 20, 'name' => 'bar']);

        $this->assertEquals(1, $listing1->ranking->rank);
        $this->assertEquals(2, $listing2->ranking->rank);

        $this->post('/listing/bar/clicks');

        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 20, 'rank' => 1]);
        $this->assertDatabaseHas('listing_rankings', ['listing_id' => 5, 'rank' => 2]);
    }
}
