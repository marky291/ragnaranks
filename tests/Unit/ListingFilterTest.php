<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Listings\ListingFilter;
use App\Mode;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingFilterTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_filter_mode()
    {
        factory(Listing::class, 2)->create(['mode_id' => 2]);

        factory(Listing::class, 3)->create(['mode_id' => 1]);

        $listings = new ListingFilter(app('listings'));

        $this->assertCount(3, $listings->filterMode('renewal')->all());
    }
    
    /**
     * @test
     */
    public function it_can_filter_by_group()
    {
        factory(Listing::class, 1)->create(['configs->base_exp_rate' => rand(101, 200)]);

        factory(Listing::class, 2)->create(['configs->base_exp_rate' => rand(1, 100)]);

        $listings = new ListingFilter(app('listings'));

        $this->assertCount(2, $listings->filterGroup('low-rate')->all());
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_attribute()
    {
        factory(Listing::class)->create(['name' => 'second', 'episode'  => 1]);

        factory(Listing::class)->create(['name' => 'first', 'episode'  => 2]);

        $listings = app('listings')->filterSort('episode');

        $this->assertEquals('first', $listings->first()->name);
    }

    /**
     * @test
     */
    public function is_can_order_the_filter_by_name()
    {
        $listing2 = factory(Listing::class)->create(['name' => 'B']);

        $listing1 = factory(Listing::class)->create(['name' => 'A']);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('name');

        $this->assertEquals($listing1->name, $collection->first()->name);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_rank()
    {
        $listing2 = $this->createListing(['name' => 'second'], 3,3);
        $listing1 = $this->createListing(['name' => 'first'], 6,2);

        /** @var Collection $listings */
        $listings = app('listings');

        // first.
        $this->assertEquals($listings->shift()->name, $listing1->name);

        // second
        $this->assertEquals($listings->shift()->name, $listing2->name);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_vote_count()
    {
        $listing2 = $this->createListing(['name' => 'second'], 1,3);

        $listing1 = $this->createListing(['name' => 'first'], 3,3);

        /** @var Collection $listings */
        $listings = app('listings')->filterSort('votes_count');

        $this->assertEquals($listings->shift()->name, $listing1->name);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_clicks_count()
    {
        $listing2 = $this->createListing(['name' => 'second'], 3,1);

        $listing1 = $this->createListing(['name' => 'first'], 1,3);

        /** @var Collection $listings */
        $listings = app('listings')->filterSort('clicks_count');

        $this->assertEquals($listings->shift()->name, $listing1->name);
    }

    /**
     * @test
     */
    public function it_can_filter_all_with_incorrect_keys()
    {
        factory(Listing::class)->create();

        $listings = new ListingFilter(app('listings'));

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

        $listings = app('listings')->filterSort('created_at');

        $this->assertEquals($listings->shift()->created_at, Carbon::today());

        $this->assertEquals($listings->shift()->created_at, Carbon::yesterday());
    }

    public function test_it_can_filter_by_tag()
    {
        /** @var Listing $listing */
        $listing1 = $this->createListing([], 0, 0,0);
        $listing2 = $this->createListing([], 0, 0,0);

        $listing1->tags()->save(factory(Tag::class)->make(['tag' => 'foo']));
        $listing2->tags()->save(factory(Tag::class)->make(['tag' => 'bar']));

        $this->assertEquals(1, app('listings')->filterTag('foo')->count());
    }
}
