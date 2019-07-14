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

        $response = $this->post('/listing', array_merge(['screenshots' => ['http://fake.com']], $listing->toArray()));

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

        $listing = factory(Listing::class)->make(['description' => fake()->sentence(10)]);

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
            'max_base_level', 'max_job_level', 'max_aspd', 'max_stats',
            'base_exp_rate', 'job_exp_rate', 'quest_exp_rate',
            'item_drop_common', 'item_drop_equip', 'item_drop_card', 'item_drop_common_mvp', 'item_drop_equip_mvp', 'item_drop_card_mvp', ];

        foreach ($fields as $field) {
            $this->configurationTest([$field => ''], $field);
            $this->configurationTest([$field => 'one-hundred'], $field);
            $this->configurationTest([$field => 0], $field);
        }
    }

    public function test_configuration_validation_boolean_conditions()
    {
        $fields = [
            'instant_cast_stat', 'pk_mode', 'arrow_decrement', 'undead_detect_type', 'attribute_recover',
        ];

        foreach ($fields as $field) {
            $this->configurationTest([$field => ''], $field);
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
