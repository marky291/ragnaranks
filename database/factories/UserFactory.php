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
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'avatarUrl' => 'https://forums.xilero.net/uploads/monthly_2019_03/Ragnarok.Chronicle_full.1603769.thumb.jpg.9228c6e958031d09fa6cf9613cacc219.jpg'
    ];
});

$factory->define(\App\Interactions\Review::class, function(Faker $faker) {
    return [
        'message' => $faker->sentence(200),
        'publisher_id' => factory(\App\User::class)->create()->id,
        'ip_address' => $faker->ipv4,
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

$factory->define(\App\Tag::class, function (Faker $faker) {
    $name = $faker->colorName;
    return [
        'tag' => str_slug($name),
        'name' => $name,
        'description' => $faker->sentence(7),
    ];
});

$factory->define(\App\Interactions\Click::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(\App\Interactions\Vote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(\App\ReviewComment::class, function (Faker $faker) {
    return [
        'message' => $faker->sentence(random_int(70, 150)),
    ];
});