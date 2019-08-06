<?php

namespace Tests\Feature;

use App\Listings\Listing;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingSpacesTest extends TestCase
{
    public function test_listing_has_a_space_when_being_created()
    {
        $listing = factory(Listing::class)->make();

        $this->assertNotNull($listing->space);
    }
}
