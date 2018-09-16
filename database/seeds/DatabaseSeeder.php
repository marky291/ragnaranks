<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:fresh');

        for ($i = 0; $i < 7; $i++)
        {
            $server = factory('App\Server')->create();

            $clicks = factory('App\ServerClick', rand(1, 100))->create(['server_id' => $server->id]);

            $votes = factory('App\ServerVote', rand(1, 200))->create(['server_id' => $server->id]);
        }
    }
}
