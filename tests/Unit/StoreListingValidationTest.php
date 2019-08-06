<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Listings\Listing;
use App\Listings\ListingConfiguration;

class StoreListingValidationTest extends TestCase
{
    public function test_storing_a_listing_vaildates_name_is_required()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['name' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('name');
    }

    public function test_storing_a_listing_vaildates_accent_is_required()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['accent' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('accent');
    }

    public function test_storing_a_listing_validates_accent_must_exist()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['accent' => 'foo']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('accent');
    }

    public function test_storing_a_listing_validates_nationality_is_required()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make();

        $response = $this->post('/listing', array_merge(['language' => ''], $listing->toArray()));

        $response->assertSessionHasErrors('language');
    }

    public function test_storing_a_listing_validates_nationality_must_exist()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make();

        $response = $this->post('/listing', array_merge(['language' => 'foo'], $listing->toArray()));

        $response->assertSessionHasErrors('language');
    }

    public function test_storing_a_listing_validates_background_is_required()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['background' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('background');
    }

    public function test_storing_a_listing_validates_tags()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make();

        $response = $this->post('/listing', array_merge(['tags' => ['foo', 'bar']], $listing->toArray()));

        $response->assertSessionHasErrors('tags.*');
    }

    public function test_storing_a_listing_validates_screenshots()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make();

        $response = $this->post('/listing', array_merge(['screenshots' => [1]], $listing->toArray()));

        $response->assertSessionHasErrors('screenshots.*');
    }

    public function test_storing_a_listing_validates_description_cannot_be_empty()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['description' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('description');
    }

    public function test_storing_a_listing_validates_website_cannot_be_empty()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['website' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('website');
    }

    public function test_storing_a_listing_validates_mode_cannot_be_empty()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['mode' => '']);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('mode');
    }

    public function test_storing_a_listing_validates_description_minimum_100()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['description' => fake()->sentence(3)]);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('description');
    }

    public function test_storing_a_listing_validates_description_is_string()
    {
        $this->signIn();

        $listing = factory(Listing::class)->make(['description' => 100]);

        $response = $this->post('/listing', $listing->toArray());

        $response->assertSessionHasErrors('description');
    }

    public function test_configuration_validation_integer_conditions()
    {
        $fields = [
            'config.max_base_level',
            'config.max_job_level',
            'config.max_aspd',
            'config.max_stats',
            'config.base_exp_rate',
            'config.job_exp_rate',
            'config.quest_exp_rate',
            'config.item_drop_common',
            'config.item_drop_equip',
            'config.item_drop_card',
            'config.item_drop_common_mvp',
            'config.item_drop_equip_mvp',
            'config.item_drop_card_mvp',
        ];

        foreach ($fields as $field) {
            $this->configurationTest([$field => ''], $field);
            $this->configurationTest([$field => 'one-hundred'], $field);
            $this->configurationTest([$field => 0], $field);
        }
    }

    public function test_configuration_validation_0_or_1_conditions()
    {
        $fields = [
            'config.instant_cast_stat',
            'config.pk_mode',
            'config.arrow_decrement',
            'config.undead_detect_type',
            'config.attribute_recover',
        ];

        foreach ($fields as $field) {
            $this->configurationTest([$field => 50], $field);
        }
    }

    private function configurationTest($attributes, $errorKey)
    {
        $this->signIn();

        $listing = factory(Listing::class)->create();

        $listing->configuration()->save(factory(ListingConfiguration::class)->make($attributes));

        $response = $this->post('/listing', array_merge($listing->toArray(), ['config' => $listing->configuration->toArray()]));

        $response->assertSessionHasErrors($errorKey);
    }
}
