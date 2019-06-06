<?php

namespace Tests\Unit;

use App\Tag;
use Carbon\Carbon;
use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\ListingCollection;
use Illuminate\Database\Eloquent\Collection;

class ListingFilterTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_filter_mode()
    {
        factory(Listing::class, 2)->create(['mode_id' => 2]);

        factory(Listing::class, 3)->create(['mode_id' => 1]);

        $listings = Listing::all();

        $this->assertCount(3, $listings->filterMode('renewal')->all());
    }

    /**
     * @test
     */
    public function it_can_filter_by_low_rate()
    {
        factory(Listing::class, 1)->create(['configs->base_exp_rate' => rand(101, 200)]);

        factory(Listing::class, 2)->create(['configs->base_exp_rate' => rand(6, 50)]);

        $listings = Listing::all();

        $this->assertCount(2, $listings->filterGroup('low-rate')->all());
    }

    /**
     * @test
     */
    public function it_can_filter_by_official_rate()
    {
        factory(Listing::class, 1)->create(['configs->base_exp_rate' => rand(1, 5)]);

        $listings = Listing::all();

        $this->assertCount(1, $listings->filterGroup('official')->all());
    }

    /**
     * @test
     */
    public function it_can_filter_by_super_high_rate()
    {
        factory(Listing::class, 1)->create(['configs->base_exp_rate' => rand(5000, 12000)]);

        $listings = Listing::all();

        $this->assertCount(1, $listings->filterGroup('super-high-rate')->all());
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_attribute()
    {
        factory(Listing::class)->create(['name' => 'second', 'episode'  => 1]);

        factory(Listing::class)->create(['name' => 'first', 'episode'  => 2]);

        $listings = Listing::all()->filterSort('episode');

        $this->assertEquals('first', $listings->first()->name);
    }

    /**
     * @test
     */
    public function is_can_order_the_filter_by_name()
    {
        $listing2 = factory(Listing::class)->create(['name' => 'B']);

        $listing1 = factory(Listing::class)->create(['name' => 'A']);

        $listings = Listing::all();

        $collection = $listings->filterSort('name');

        $this->assertEquals($listing1->name, $collection->first()->name);
    }

    /**
     * @test
     */
    public function it_can_filter_all_with_incorrect_keys()
    {
        factory(Listing::class)->create();

        $listings = Listing::all();

        $collection = $listings->filterMode('bad')->filterGroup('key')->filterSort('entries')->all();

        $this->assertCount(1, $collection);
    }

    /**
     * @test
     */
    public function it_can_filter_descending_order_created_at()
    {
        $this->createListing(['created_at' => Carbon::yesterday()], 0, 0);

        $this->createListing(['created_at' => Carbon::today()], 0, 0);

        $listings = Listing::all()->filterSort('created_at');

        $this->assertEquals($listings->shift()->created_at, Carbon::today());

        $this->assertEquals($listings->shift()->created_at, Carbon::yesterday());
    }

    public function test_it_can_filter_by_tag()
    {
        /** @var Listing $listing */
        $listing1 = $this->createListing([], 0, 0, 0);
        $listing2 = $this->createListing([], 0, 0, 0);

        $listing1->tags()->save(factory(Tag::class)->make(['tag' => 'foo']));
        $listing2->tags()->save(factory(Tag::class)->make(['tag' => 'bar']));

        $this->assertEquals(1, Listing::all()->filterTag('foo')->count());
    }
}
