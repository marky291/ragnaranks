<?php

namespace Tests\Feature;

use App\Interactions\Click;
use App\Listings\Listing;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClickRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_not_authorize_more_than_one_click_every_one_hours()
    {
        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $listing->clicks()->save(factory(Click::class)->create(['created_at' => now(), 'ip_address' => '127.0.0.1']));

        $this->post("/listing/listing-name/clicks", [], ['REMOTE_ADDR' => '127.0.0.1']);

        $this->assertCount(1, $listing->clicks);
    }

    /**
     * @test
     */
    public function it_can_store_a_new_click()
    {
        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $this->post("/listing/listing-name/clicks", [], ['REMOTE_ADDR' => '10.1.0.1'])->assertOk();

        $this->assertCount(1, $listing->clicks);

        $this->assertDatabaseHas('clicks', ['ip_address' => '10.1.0.1']);
    }
}
