<?php

namespace Tests\Unit;

use App\Console\Commands\RankingRebuilder;
use Tests\TestCase;
use App\Listings\Listing;
use App\Jobs\ReconstructRankingTable;
use App\Http\Resources\ListingResource;

class ListingResourceTest extends TestCase
{
    public function test_it_has_a_name()
    {
        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['name']);
    }

    public function test_it_has_a_slug()
    {
        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['slug']);
    }

    public function test_it_has_a_mode()
    {
        $listing = factory(Listing::class)->create(['mode' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['mode']);
    }

    public function test_it_has_a_website()
    {
        $listing = factory(Listing::class)->create(['website' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['website']);
    }

    public function test_it_has_a_ranking()
    {
        $listing = factory(Listing::class)->create();

        $this->artisan(RankingRebuilder::class);

        $this->assertEquals(1, ListingResource::make($listing->load('ranking'))['ranking']['rank']);
    }

    public function test_it_has_a_background()
    {
        $listing = factory(Listing::class)->create(['background' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['background']);
    }

    public function test_it_has_a_description()
    {
        $listing = factory(Listing::class)->create(['description' => 'foo']);

        $this->assertEquals('foo', ListingResource::make($listing)['description']);
    }
}
