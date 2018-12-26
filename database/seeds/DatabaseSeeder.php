<?php

use App\Click;
use App\Listings\Listing;
use App\Tag;
use App\Vote;
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

        $tags = Tag::all();

        $server_count = 15;

        $servers = factory(Listing::class, $server_count)->create();

        $progress = $this->command->getOutput()->createProgressBar($server_count);

        $this->command->alert("Generating {$server_count} servers for Ragnaranks");

        /** @var Listing $server */
        foreach ($servers as $server)
        {
            // update the progress bar
            $progress->advance();

            $server->votes()->saveMany(factory(Vote::class, rand(200, 500))->create());

            $server->reviews()->saveMany(factory(\App\Review::class, rand(1, 30))->create());

            $server->clicks()->saveMany(factory(Click::class, rand(200, 500))->create());

            $server->tags()->saveMany($tags->random(3)->unique('id'));

            $this->command->info("\tGenerated {$server->name}");
        }
    }
}
