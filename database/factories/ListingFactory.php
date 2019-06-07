<?php


use App\Mode;
use Carbon\Carbon;
use App\Listings\Listing;
use Faker\Generator as Faker;
use App\Listings\ListingLanguage;

$factory->define(\App\Listings\ListingScreenshot::class, function (Faker $faker) {
    return [
        'listing_id' => factory(Listing::class)->create()->getKey(),
        'link' => $faker->imageUrl(640, 480, 'cats'),
    ];
});

$factory->define(ListingLanguage::class, function (Faker $faker) {
    return [
        'name' => $faker->languageCode,
    ];
});

$factory->define(Listing::class, function (Faker $faker) {
    $server = array_random(config('fake.listings'));

    return [
        'name' => $server['name'],
        'configs' => [
            'max_base_level' => rand(config('filter.exp.low-rate.min'), config('filter.exp.high-rate.max')),
            'max_job_level' => rand(99, 255),
            'max_stats' => rand(150, 255),
            'max_aspd' => rand(150, 195),
            'base_exp_rate' => rand(1, 5000),
            'job_exp_rate' => rand(1, 5000),
            'instant_cast_stat' => rand(100, 150),
            'drop_base_rate' => rand(5, 10000),
            'drop_card_rate' => rand(5, 10000),
            'drop_base_mvp_rate' => rand(20, 10000),
            'drop_card_mvp_rate' => rand(20, 10000),
            'drop_base_special_rate' => rand(20, 10000),
            'drop_card_special_rate' => rand(20, 10000),
        ],
        'user_id' => factory('App\User')->create()->id,
        'website' => $faker->url,
        'mode_id' => Mode::inRandomOrder()->first(),
        'description' => $server['description'],
        'language_id' => ListingLanguage::all()->random()->getKey(),
        'episode' => collect([13.10, 13.09, 13.05, 12.11])->random(),
        'background' => $server['banner'],
        'created_at' => Carbon::now()->subHours(rand(1, 500)),
    ];
});
