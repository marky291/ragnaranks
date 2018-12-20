<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Listings\ListingFilter;
use App\Mode;
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
        $listing2 = factory(Listing::class)->create(['episode'  => 2]);

        $listing1 = factory(Listing::class)->create(['episode'  => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('episode');

        $this->assertEquals($listing1->episode, $collection->first()->episode);
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
        $listing2 = factory(Listing::class)->create(['statistics->rank' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->rank' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('rank');

        $this->assertEquals($listing1->statistics['rank'], $collection->first()->statistics['rank']);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_rank_growth()
    {
        $listing2 = factory(Listing::class)->create(['statistics->rank_growth' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->rank_growth' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('rank_growth');

        $this->assertEquals($listing1->statistics['rank_growth'], $collection->first()->statistics['rank_growth']);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_vote_count()
    {
        $listing2 = factory(Listing::class)->create(['statistics->vote_count' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->vote_count' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('vote_count');

        $this->assertEquals($listing1->statistics['vote_count'], $collection->first()->statistics['vote_count']);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_vote_trend()
    {
        $listing2 = factory(Listing::class)->create(['statistics->votes_trend' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->votes_trend' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('votes_trend');

        $this->assertEquals($listing1->statistics['votes_trend'], $collection->first()->statistics['votes_trend']);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_clicks_count()
    {
        $listing2 = factory(Listing::class)->create(['statistics->clicks_count' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->clicks_count' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('clicks_count');

        $this->assertEquals($listing1->statistics['clicks_count'], $collection->first()->statistics['clicks_count']);
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_clicks_trend()
    {
        $listing2 = factory(Listing::class)->create(['statistics->clicks_trend' => 2]);

        $listing1 = factory(Listing::class)->create(['statistics->clicks_trend' => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('clicks_trend');

        $this->assertEquals($listing1->statistics['clicks_trend'], $collection->first()->statistics['clicks_trend']);
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
}
