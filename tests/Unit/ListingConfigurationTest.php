<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\ListingConfiguration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingConfigurationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ListingConfiguration
     */
    private $configuration;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();

        $listing = factory(Listing::class)->create(['name' => 'foo']);

        $listing->configuration()->save(factory(ListingConfiguration::class)->make(['base_exp_rate' => 8]));

        $this->configuration = $listing->configuration;
    }

    /**
     * 'max_base_level','max_job_level','max_stats','max_aspd','base_exp_rate',
     * 'job_exp_rate','instant_cast_stat','drop_base_rate', 'drop_card_rate',
     * 'drop_base_mvp_rate','drop_card_mvp_rate', 'drop_base_special_rate',
     * 'drop_card_special_rate'.
     */
    public function test_it_has_a_max_base_level()
    {
        $this->assertNotNull($this->configuration->max_base_level);
    }

    public function test_it_has_a_max_job_level()
    {
        $this->assertNotNull($this->configuration->max_job_level);
    }

    public function test_it_has_a_max_stats()
    {
        $this->assertNotNull($this->configuration->max_stats);
    }

    public function test_it_has_a_max_aspd()
    {
        $this->assertNotNull($this->configuration->max_aspd);
    }

    public function test_it_has_a_base_exp_rate()
    {
        $this->assertNotNull($this->configuration->base_exp_rate);
    }

    public function test_it_has_a_job_exp_rate()
    {
        $this->assertNotNull($this->configuration->job_exp_rate);
    }

    public function test_it_has_a_instant_cast_stat()
    {
        $this->assertNotNull($this->configuration->instant_cast_stat);
    }

    public function test_it_has_a_pk_mode()
    {
        $this->assertNotNull($this->configuration->pk_mode);
    }

    public function test_it_has_a_castrate_dex_Scale()
    {
        $this->assertNotNull($this->configuration->castrate_dex_scale);
    }

    public function test_it_has_a_drop_base_mvp_rate()
    {
        $this->assertNotNull($this->configuration->arrow_decrement);
    }

    public function test_it_has_a_drop_card_mvp_rate()
    {
        $this->assertNotNull($this->configuration->undead_detect_type);
    }

    public function test_it_has_a_drop_base_special_rate()
    {
        $this->assertNotNull($this->configuration->attribute_recover);
    }

    public function test_it_has_a_drop_common_rate()
    {
        $this->assertNotNull($this->configuration->item_drop_common);
    }

    public function test_it_has_a_drop_equip_rate()
    {
        $this->assertNotNull($this->configuration->item_drop_equip);
    }

    public function test_it_has_a_drop_card_rate()
    {
        $this->assertNotNull($this->configuration->item_drop_card);
    }

    public function test_it_has_a_drop_common_mvp()
    {
        $this->assertNotNull($this->configuration->item_drop_common_mvp);
    }

    public function test_it_has_a_drop_equip_mvp()
    {
        $this->assertNotNull($this->configuration->item_drop_equip_mvp);
    }

    public function test_it_has_a_drop_card_mvp()
    {
        $this->assertNotNull($this->configuration->item_drop_card_mvp);
    }


    public function test_is_has_a_listing_relationship()
    {
        $this->assertInstanceOf(Listing::class, $this->configuration->listing);
    }
}
