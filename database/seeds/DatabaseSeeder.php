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

        $server_count = 35;

        /**
         * Generation Seeder.
         */
        for ($i = 0; $i < $server_count; $i++)
        {
            /** @var Server $server */
            $server = factory('App\Server')->create();

            factory('App\ServerClick', rand(200, 500))->create(['server_id' => $server->id]);

            factory('App\ServerVote', rand(100, 300))->create(['server_id' => $server->id]);

            App\Jobs\UpdateServerTrendGrowth::dispatchNow($server);

            echo "Created [{$i}/{$server_count}] {$server->name}\n";

            // ATTACH SOME FAKE TAGS TO THE SERVER.
            $tags = Tag::all();
            for ($j=0; $j<rand(1,5); ++$j) {
                $server->tags()->attach($tags->pull(rand(1, $tags->count())));
            }
        }

        // DISPATCH RANK QUERY.
        App\Jobs\RankServerCollection::dispatchNow(Server::all());
    }
}
