<?php

namespace App\Listings;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;

class CacheListingsContainer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        Cache::rememberForever('listings', function()
        {
            $listings = Listing::query()->withCount(['votes', 'clicks'])->with(['mode', 'tags'])->get();

            $listings = $listings->sortByDesc(function(Listing $listing)  {
                return $listing->points;
            });

            $listings = $listings->values()->each(function (Listing $listing, int $key) {
                $listing->setAttribute('rank', $key + 1);
            });

            return $listings;
        });
    }
}
