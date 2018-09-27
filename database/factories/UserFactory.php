<?php

use App\ServerMode;
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

    $server = collect([
        [
            'name' => 'TalonRO',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000016173_d6713827.gif',
            'description' =>'5/5/3 ~ 8/8/3 • Stable/Lagfree/Balanced • No Wipes, Up for 10+ years • Ep 14.1 • 180+ Custom Hair • 1000+ Hats • 1400-1900 Players • Custom Dye/Pets/Q...',
        ],
        [
            'name' => 'Forsaken Ragnarok Online',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093589_4fcad066.gif',
            'description' =>'6k/6k/100 max lvl 255/255 questable/votable donations guild/newbie packs up for 5+ years, no wipes, stable intense WOE/GVG/PVP',
        ],
        [
            'name' => 'Philippine Ragnarok Online Project Chaos',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000094148_fa37e810.jpeg',
            'description' => 'The server is on Pre-renewal Classic Trans server! - Max Level 99/70 - 1st Month Rates: 25x/25x/7x - Default Rate: 10x/10x/5x - No BOT - No Multi...',
        ],
        [
            'name' => 'Dreamer RO',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093313_49d64324.png',
            'description' => 'Rates: 8k/8k/3k // MaxLvl: 500/120 // Renewal content with some Pre-RE mechanics // 3rd Jobs // Oboro, Kagerou, Rebellion, Dorams // Active PvP // Bat...',
        ],
        [
            'name' => 'Revival Online Private Server',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093763_37c9af60.gif',
            'description' => 'RevivalRO located in ASIA NO LAG Loki server Rates: 100x/100x/20x - Maximum Level: 255/120 1200+ Hats many Custom Instances/Monster/Items 300 to 550 p...',
        ],
        [
            'name' => 'Ragnarok Online Island',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093898_5fa09420.png',
            'description' => 'ONLINE 1000+ | Launched: 13. June 2018 | International Mid-Rate (df server) | Pre-RE | Episode 13.3+ | Rates: 77x77x33x~99x99x44x | BattleGrounds 2.0...',
        ],
        [
            'name' => 'Estland Ragnarok Online',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000087155_778d886e.jpeg',
            'description' => '[ 500+ Players Online ] [ Low & Mid 99/70 - Pre-Re Servers ] [ Low: 13x13x5x ~ 15x15x7x ] [ Mid: 130x130x30x ~ 150x150x50x ] [ Stable working eAmod ] ...',
        ]
    ]);

    $server = $server->random();

    return [
        'name' => $server['name'],
        'user_id' => factory('App\User')->create()->id,
        'website' => $faker->url,
        'mode_id' => ServerMode::inRandomOrder()->first(),
        'description' => $server['description'],
        'episode' => collect([13.10, 13.09, 13.05, 12.11])->random(),
        'votes_count' => $faker->numberBetween(1, 19500),
        'clicks_count' => $faker->numberBetween(1, 19500),
        'banner_url' => $server['banner'],
    ];
});

$factory->afterCreating(\App\Server::class, function ($server, $faker) {
    $server->config()->save(factory(\App\ServerConfig::class)->make());
});

$factory->define(App\ServerMode::class, function (Faker $faker) {
    return [
        'tag' => $faker->text(5),
        'name' => $faker->text(9),
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\ServerClick::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => now(),
    ];
});

$factory->define(App\ServerVote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => now(),
    ];
});

$factory->define(App\ServerConfig::class, function (Faker $faker) {
    return [
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
    ];
});

$factory->define(\App\ServerReport::class, function (Faker $faker) {
    return [
        'vote_count' => $faker->numberBetween(1, 25000),
        'click_count' => $faker->numberBetween(1, 25000),
    ];
});