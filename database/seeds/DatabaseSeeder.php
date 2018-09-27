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

        for ($i = 0; $i < 750; $i++)
        {
            $server = factory('App\Server')->create();

            $clicks = factory('App\ServerClick', rand(200, 500))->create(['server_id' => $server->id]);

            $votes = factory('App\ServerVote', rand(100, 300))->create(['server_id' => $server->id]);

            echo "Created {$server->name} : row {$i}\n";
        }
    }
}
