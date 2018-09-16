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

$factory->define(App\Server::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'website' => $faker->url,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\ServerClick::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'server_id' => factory('App\Server')->create()->id,
    ];
});

$factory->define(App\ServerVote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'server_id' => factory('App\Server')->create()->id,
    ];
});
