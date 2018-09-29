<?php

use App\Server;
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

        for ($i = 0; $i < 500; $i++)
        {
            /** @var Server $server */
            $server = factory('App\Server')->create();

            factory('App\ServerClick', rand(200, 500))->create(['server_id' => $server->id]);

            factory('App\ServerVote', rand(100, 300))->create(['server_id' => $server->id]);

            App\Jobs\UpdateServerTrendGrowth::dispatchNow($server);

            echo "Created {$server->name} : row {$i}\n";
        }

        App\Jobs\RankServerCollection::dispatchNow(Server::all());
    }
}
