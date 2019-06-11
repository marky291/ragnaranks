<?php

namespace App\Jobs;

use App\Listings\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BuildListingRankingTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $counter = 0;

        Listing::withCount(['clicks', 'votes'])->chunkById(100, function ($listings) use (&$counter) {
            $listings = $listings->sortByDesc(static function (Listing $listing) {
                return $listing->points;
            });

            foreach ($listings as $listing) {
                $listing->ranking()->firstOrCreate(
                    ['listing_id' => $listing->id], ['rank' => ++$counter, 'points' => $listing->points, 'votes' => $listing->votes_count, 'clicks' => $listing->clicks_count]
                )->save();
            }
        });
    }
}
