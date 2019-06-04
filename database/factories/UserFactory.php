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
        'avatarUrl' => $faker->imageUrl(640, 480),
    ];
});

$factory->define(\App\Interactions\Review::class, function (Faker $faker) {
    return [
        'message' => $faker->text(rand(300, 500)),
        'publisher_id' => factory(\App\User::class)->create()->id,
        'ip_address' => $faker->ipv4,
        'donation_score' => $faker->numberBetween(0, 5),
        'update_score' => $faker->numberBetween(0, 5),
        'class_score' => $faker->numberBetween(0, 5),
        'item_score' => $faker->numberBetween(0, 5),
        'support_score' => $faker->numberBetween(0, 5),
        'hosting_score' => $faker->numberBetween(0, 5),
        'content_score' => $faker->numberBetween(0, 5),
        'event_score' => $faker->numberBetween(0, 5),
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
