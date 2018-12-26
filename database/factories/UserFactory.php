<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Review::class, function(Faker $faker) {
    return [
        'message' => $faker->realText(200),
        'listing_id' => factory(\App\Listings\Listing::class)->create()->id,
        'donation_score' => $faker->numberBetween(0, 10),
        'update_score' => $faker->numberBetween(0, 10),
        'class_score' => $faker->numberBetween(0, 10),
        'item_score' => $faker->numberBetween(0, 10),
        'support_score' => $faker->numberBetween(0, 10),
        'hosting_score' => $faker->numberBetween(0, 10),
        'content_score' => $faker->numberBetween(0, 10),
        'event_score' => $faker->numberBetween(0, 10),
    ];
});

$factory->define(App\Mode::class, function (Faker $faker) {
    return [
        'tag' => $faker->text(5),
        'name' => $faker->text(9),
        'description' => $faker->paragraph,
    ];
});

$factory->define(\App\Click::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(\App\Vote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});