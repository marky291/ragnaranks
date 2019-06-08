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
    protected function setUp()
    {
        parent::setUp();

        $this->configuration = factory(ListingConfiguration::class)->create();
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

    public function test_it_has_a_drop_base_rate()
    {
        $this->assertNotNull($this->configuration->drop_base_rate);
    }

    public function test_it_has_a_drop_card_rate()
    {
        $this->assertNotNull($this->configuration->drop_card_rate);
    }

    public function test_it_has_a_drop_base_mvp_rate()
    {
        $this->assertNotNull($this->configuration->drop_base_mvp_rate);
    }

    public function test_it_has_a_drop_card_mvp_rate()
    {
        $this->assertNotNull($this->configuration->drop_card_mvp_rate);
    }

    public function test_it_has_a_drop_base_special_rate()
    {
        $this->assertNotNull($this->configuration->drop_base_special_rate);
    }

    public function test_it_has_a_drop_card_special_rate()
    {
        $this->assertNotNull($this->configuration->drop_card_special_rate);
    }

    public function test_is_has_a_listing_relationship()
    {
        $this->assertInstanceOf(Listing::class, $this->configuration->listing);
    }
}
