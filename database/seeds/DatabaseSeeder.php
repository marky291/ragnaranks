<?php

use App\Tag;
use App\User;
use App\Listings\Listing;
use App\Interactions\Vote;
use App\Interactions\Click;
use App\Interactions\Review;
use Illuminate\Database\Seeder;
use App\Listings\ListingScreenshot;
use App\Listings\ListingConfiguration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * @var ProgressBar
     */
    private $progress_bar;

    /**
     * @var array
     */
    private $seed_counts;

    /**
     * @var Collection
     */
    private $listings;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:fresh');

        Artisan::call('cache:clear');

        $this->setup();

        $this->seedDatabase();

        $this->seedInteractions();
    }

    /**
     * DatabaseSeeder constructor.
     */
    public function setup()
    {
        $this->seed_counts = ['listings' => 2000, 'votes' => 100000, 'clicks' => 100000, 'reviews' => rand(1200, 1700), 'screenshots' => rand(1500, 2500)];

        $this->progress_bar = new ProgressBar($this->command->getOutput(), $this->seed_counts['listings'] + $this->seed_counts['votes'] + $this->seed_counts['clicks'] + $this->seed_counts['reviews']);

        $this->progress_bar->advance();

        $this->command->warn("\tInitialized Seeder \t");
    }

    /**
     * Setup a starting database for seeding.
     */
    public function seedDatabase()
    {
        factory(Listing::class, $this->seed_counts['listings'])->create()->each(function (Listing $listing) {
            $listing->tags()->saveMany(Tag::all()->random(rand(1, 4))->unique('id'));
            $listing->configuration()->save(factory(ListingConfiguration::class)->make());
            $this->progress_bar->advance();
        })->unique('slug');

        $this->listings = Listing::all();

        $this->progress_bar->advance();

        $this->command->warn("\t{$this->seed_counts['listings']} listings generated.");
    }

    /**
     * Seed some interactions that would be made on the site.
     */
    public function seedInteractions()
    {
        for ($i = 0; $i < $this->seed_counts['votes']; $i++) {
            $this->listings->random(1)->first()->votes()->save(factory(Vote::class)->make());
            $this->progress_bar->advance();
        }

        for ($i = 0; $i < $this->seed_counts['clicks']; $i++) {
            $this->listings->random(1)->first()->clicks()->save(factory(Click::class)->make());
            $this->progress_bar->advance();
        }

        for ($i = 0; $i < $this->seed_counts['reviews']; $i++) {
            try {
                $this->listings->random(1)->first()->reviews()->save(factory(Review::class)->make(
                    ['user_id' => User::all()->random()->id]
                ));
            } catch (Exception $e) {
                //
            }
            $this->progress_bar->advance();
        }

        for ($i = 0; $i < $this->seed_counts['screenshots']; $i++) {
            $this->listings->random(1)->first()->screenshots()->save(factory(ListingScreenshot::class)->make());
            $this->progress_bar->advance();
        }

        $this->progress_bar->advance();

        $this->command->warn("\t{$this->seed_counts['votes']} Votes, {$this->seed_counts['clicks']} Clicks & {$this->seed_counts['reviews']} reviews interacted.");

        $this->command->info("\nBuilding cache table...\n");

        $this->command->call('ranking:rebuilder');
    }
}
