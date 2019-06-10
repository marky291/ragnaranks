<?php

namespace Tests\Unit;

use App\Http\Resources\ListingResource;
use App\Listings\ListingConfiguration;
use App\Mode;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Listings\Listing;

class ListingFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_empty_result_on_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 3])
        );

        $response = $this->getJson('api/servers/official-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_official_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 2])
        );

        $response = $this->getJson('api/servers/official-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_low_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 10])
        );

        $response = $this->getJson('api/servers/low-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_mid_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 60])
        );

        $response = $this->getJson('api/servers/mid-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_high_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 500])
        );

        $response = $this->getJson('api/servers/high-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_super_high_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->create(['base_exp_rate' => 10000])
        );

        $response = $this->getJson('api/servers/super-high-rate/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_all_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        $response = $this->getJson('api/servers/all/all/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_renewal_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'renewal']);

        $response = $this->getJson('api/servers/all/renewal/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_prerenewal_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'pre-renewal']);

        $response = $this->getJson('api/servers/all/pre-renewal/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_custom_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'custom']);

        $response = $this->getJson('api/servers/all/custom/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }

    public function test_it_can_filter_classic_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'classic']);

        $response = $this->getJson('api/servers/all/classic/all/all/7');

        $response->assertJson(['data' => [ListingResource::make($listing)->jsonSerialize()]]);
    }
}
