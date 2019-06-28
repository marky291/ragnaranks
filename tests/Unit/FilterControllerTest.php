<?php

namespace Tests\Unit;

use App\Tag;
use Tests\TestCase;
use App\Listings\Listing;
use App\Interactions\Click;
use App\Jobs\BuildListingRankingTable;
use App\Listings\ListingConfiguration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_empty_result_on_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 3])
        );

        $response = $this->getJson('api/servers/official-rate/all/all/all/7');

        $response->assertJson(['data' => []]);
    }

    public function test_it_can_filter_official_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 2])
        );

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('/api/servers/official-rate/all/all/rank/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_low_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 10])
        );

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/low-rate/all/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_mid_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 60])
        );

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/mid-rate/all/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_high_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 500])
        );

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/high-rate/all/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_super_high_rate()
    {
        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(
            factory(ListingConfiguration::class)->make(['base_exp_rate' => 10000])
        );

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/super-high-rate/all/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_all_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create();

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_renewal_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'renewal']);

        $listing2 = factory(Listing::class)->create(['mode' => 'classic']);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/renewal/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_prerenewal_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'pre-renewal']);

        $listing2 = factory(Listing::class)->create(['mode' => 'customo']);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/pre-renewal/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_custom_mode()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['mode' => 'custom']);

        $listing2 = factory(Listing::class)->create(['mode' => 'pre-renewal']);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/custom/all/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_classic_mode()
    {
        /** @var Listing $listing */
        $listing1 = factory(Listing::class)->create(['mode' => 'classic']);

        $listing2 = factory(Listing::class)->create(['mode' => 'renewal']);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/classic/all/all/7');

        $response->assertJson(['data' => [['name' => $listing1->name]]]);
    }

    public function test_it_can_filter_freebies_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'freebies')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/freebies/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_gepard_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'gepard')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/gepard/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_guild_pack_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'guild-pack')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/guild-pack/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_mobile_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'mobile')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/mobile/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_frost_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'frost')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/frost/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_no_donations_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'no-donations')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/no-donations/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_instant_level_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'instant-level')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/instant-level/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_filter_themed_server_tag()
    {
        $listing = factory(Listing::class)->create();

        $tags = $listing->tags()->save(Tag::where('name', 'themed-server')->first());

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/themed-server/all/7');

        $response->assertJson(['data' => [['name' => $listing->name]]]);
    }

    public function test_it_can_sort_by_rank()
    {
        $foo = factory(Listing::class)->create(['name' => 'foo']);
        $foo->clicks()->saveMany(factory(Click::class, 5)->make(['created_at' => now()]));

        $bar = factory(Listing::class)->create(['name' => 'bar']);
        $bar->clicks()->saveMany(factory(Click::class, 3)->make(['created_at' => now()]));

        $bar = factory(Listing::class)->create(['name' => 'zoo']);
        $bar->clicks()->saveMany(factory(Click::class, 6)->make(['created_at' => now()]));

        $bar = factory(Listing::class)->create(['name' => 'zan']);
        $bar->clicks()->saveMany(factory(Click::class, 20)->make(['created_at' => now()]));

        $bar = factory(Listing::class)->create(['name' => 'zap']);
        $bar->clicks()->saveMany(factory(Click::class, 2)->make(['created_at' => now()]));

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/all/rank/7');

        /** @var Listing $listing */
        foreach ($response->original as $position => $listing) {
            if ($position == 0) {
                $this->assertEquals('zan', $listing->name);
            }

            if ($position == 1) {
                $this->assertEquals('zoo', $listing->name);
            }

            if ($position == 2) {
                $this->assertEquals('foo', $listing->name);
            }

            $this->assertEquals(++$position, $listing->ranking->rank);
        }
    }

    public function test_it_can_sort_by_server_name()
    {
        $listing1 = factory(Listing::class)->create(['name' => 'charlie']);
        $listing2 = factory(Listing::class)->create(['name' => 'bravo']);
        $listing3 = factory(Listing::class)->create(['name' => 'alpha']);
        $listing4 = factory(Listing::class)->create(['name' => 'echo']);
        $listing5 = factory(Listing::class)->create(['name' => 'delta']);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/all/name/7');

        /** @var Listing $listing */
        foreach ($response->original as $index => $listing) {
            if ($index === 0) {
                $this->assertEquals('alpha', $listing->name);
            }
            if ($index === 1) {
                $this->assertEquals('bravo', $listing->name);
            }
            if ($index === 2) {
                $this->assertEquals('charlie', $listing->name);
            }
            if ($index === 3) {
                $this->assertEquals('delta', $listing->name);
            }
            if ($index === 4) {
                $this->assertEquals('echo', $listing->name);
            }
        }
    }

    public function test_it_can_sort_by_creation_date()
    {
        $listing1 = factory(Listing::class)->create(['name'=>'alpha', 'created_at' => now()->subHours(12)]);
        $listing2 = factory(Listing::class)->create(['name'=>'bravo', 'created_at' => now()]);
        $listing3 = factory(Listing::class)->create(['name'=>'charlie', 'created_at' => now()->subMinute(39)]);
        $listing4 = factory(Listing::class)->create(['name'=>'delta', 'created_at' => now()->subDays(33)]);
        $listing5 = factory(Listing::class)->create(['name'=>'echo', 'created_at' => now()->subMinute()]);

        BuildListingRankingTable::dispatchNow();

        $response = $this->getJson('api/servers/all/all/all/name/7');

        /** @var Listing $listing */
        foreach ($response->original as $index => $listing) {
            if ($index === 0) {
                $this->assertEquals('bravo', $listing2->name);
            }
            if ($index === 1) {
                $this->assertEquals('echo', $listing5->name);
            }
            if ($index === 2) {
                $this->assertEquals('charlie', $listing3->name);
            }
            if ($index === 3) {
                $this->assertEquals('alpha', $listing1->name);
            }
            if ($index === 4) {
                $this->assertEquals('delta', $listing4->name);
            }
        }
    }
}
