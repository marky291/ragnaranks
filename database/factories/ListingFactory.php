<?php

use Carbon\Carbon;
use App\Listings\Listing;
use Faker\Generator as Faker;
use App\Listings\ListingLanguage;

$factory->define(\App\Listings\ListingScreenshot::class, static function (Faker $faker) {
    return [
        'link' => $faker->imageUrl(640, 480, 'cats'),
    ];
});

$factory->define(ListingLanguage::class, function (Faker $faker) {
    return [
        'name' => $faker->languageCode,
    ];
});

$factory->define(Listing::class, static function (Faker $faker) {
    $server = array_random(config('fake.listings'));

    return [
        'name' => $server['name'],
        'user_id' => factory('App\User')->create()->id,
        'website' => $faker->url,
        'mode' => $faker->randomElement(array_keys(trans('homepage.mode'))),
        'description' => trans('profile.defaultMarkup'),
        'language_id' => ListingLanguage::all()->random()->getKey(),
        'episode' => collect([13.10, 13.09, 13.05, 12.11])->random(),
        'background' => $server['banner'],
        'created_at' => Carbon::now()->subHours($faker->numberBetween(1, 500)),
    ];
});

$factory->define(\App\Listings\ListingConfiguration::class, static function (Faker $faker) {
    return [
        'max_base_level' => $faker->numberBetween(99, 255),
        'max_job_level' => $faker->numberBetween(99, 255),
        'max_stats' => $faker->numberBetween(150, 255),
        'max_aspd' => $faker->numberBetween(150, 195),
        'base_exp_rate' =>$faker->numberBetween(config('filter.exp.low-rate.min'), config('filter.exp.high-rate.max') + 1200),
        'job_exp_rate' => $faker->numberBetween(config('filter.exp.low-rate.min'), config('filter.exp.high-rate.max') + 1200),
        'quest_exp_rate' => $faker->numberBetween(config('filter.exp.low-rate.min'), config('filter.exp.high-rate.max') + 1200),
        'instant_cast_stat' => $faker->boolean(),
        'pk_mode' => $faker->boolean(),
        'castrate_dex_scale' => $faker->boolean(),
        'arrow_decrement' => $faker->boolean(),
        'undead_detect_type' => $faker->boolean(),
        'attribute_recover' => $faker->boolean(),
        'item_drop_common' => $faker->numberBetween(5, 10000),
        'item_drop_equip' => $faker->numberBetween(1, 10000),
        'item_drop_card' => $faker->numberBetween(20, 10000),
        'item_drop_common_mvp' => $faker->numberBetween(20, 10000),
        'item_drop_equip_mvp' => $faker->numberBetween(20, 10000),
        'item_drop_card_mvp' => $faker->numberBetween(20, 10000),
    ];
});
