<?php

use App\Interactions\Click;
use App\Listings\Listing;
use App\Interactions\Review;
use App\Listings\ListingScreenshot;
use App\Tag;
use App\Interactions\Vote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        $this->progress_bar = new ProgressBar($this->command->getOutput(), 3);

        $this->seed_counts = ['listings' => rand(10, 15), 'votes' => rand(50, 90), 'clicks' => rand(60, 120), 'reviews' => rand(10, 20), 'screenshots' => rand(15, 40)];

        $this->progress_bar->advance();

        $this->command->warn("\tInitialized Seeder \t");
    }

    /**
     * Setup a starting database for seeding.
     */
    public function seedDatabase()
    {
        factory(Listing::class, $this->seed_counts['listings'])->create()->each(function(Listing $listing) {
            $listing->tags()->saveMany(Tag::all()->random(rand(1, 4))->unique('id'));
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
            $this->listings->random(1)->first()->votes()->save(factory(Vote::class)->create());
        }

        for ($i = 0; $i < $this->seed_counts['clicks']; $i++) {
            $this->listings->random(1)->first()->clicks()->save(factory(Click::class)->create());
        }

        for ($i = 0; $i < $this->seed_counts['reviews']; $i++) {
            $this->listings->random(1)->first()->reviews()->save(factory(Review::class)->create());
        }

        for ($i = 0; $i < $this->seed_counts['screenshots']; $i++) {
            $this->listings->random(1)->first()->screenshots()->save(factory(ListingScreenshot::class)->create());
        }

        $this->progress_bar->advance();

        $this->command->warn("\t{$this->seed_counts['votes']} Votes, {$this->seed_counts['clicks']} Clicks & {$this->seed_counts['reviews']} reviews interacted.");
    }
}
