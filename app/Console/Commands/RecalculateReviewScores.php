<?php

namespace App\Console\Commands;

use App\Listings\Listing;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class RecalculateReviewScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate all listing review scores.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listings = Listing::has('reviews')->get();

        /** @var Listing|Collection $listing */
        foreach ($listings as $listing)
        {
            $average_score = $listing->reviews()->avg('average_score');

            $listing->update(['review_score' => $average_score]);

            $this->info("Applied review score of {$average_score} to {$listing->name}");
        }
    }
}
