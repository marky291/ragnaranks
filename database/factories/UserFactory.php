<?php

use App\User;
use App\Interactions\Vote;
use App\Interactions\Click;
use App\Interactions\Review;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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
/* @var Factory $factory */

$factory->define(User::class, static function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'email_preference' => $faker->randomElement(['all', 'important']),
        'remember_token' => str_random(10),
        'avatarUrl' => 'http://ragnaranks.com/img/preset/avatar.png',
    ];
});

$factory->define(Review::class, function (Faker $faker) {
    return [
        'message' => $faker->text(rand(300, 500)),
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
    return [
        'name' => str_slug($faker->colorName),
    ];
});

$factory->define(Click::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Vote::class, function (Faker $faker) {
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
