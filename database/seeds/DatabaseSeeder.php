<?php

use App\Server;
use App\Tag;
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

        $server_count = 15;

        $servers = factory('App\Server', $server_count)->create();

        $progress = $this->command->getOutput()->createProgressBar($server_count);

        $this->command->alert("Generating {$server_count} servers for Ragnaranks");

        foreach ($servers as $server)
        {
            // update the progress bar
            $progress->advance();

            // generate some fake clicks for the server.
            factory('App\ServerClick', rand(200, 500))->create(['server_id' => $server->id]);

            // generate some fake votes for the server.
            factory('App\ServerVote', rand(100, 300))->create(['server_id' => $server->id]);

            // generate the trend growth stats for the server.
            App\Jobs\UpdateServerTrendGrowth::dispatchNow($server);

            // grab all the tags.
            $tags = Tag::all();

            // generate some tags for the server.
            for ($j = 0; $j < rand(1, 5); ++$j) {
                $server->tags()->attach($tags->pull(rand(1, $tags->count())));
            }

            // console information about the creation.
            $this->command->line("\tGenerated {$server->name}");
        }

        // dispatch the job to calculate server ranks.
        App\Jobs\RankServerCollection::dispatchNow(Server::all());
    }
}
