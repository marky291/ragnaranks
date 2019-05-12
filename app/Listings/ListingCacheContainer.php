<?php

namespace App\Listings;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;

class ListingCacheContainer implements ShouldQueue
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
        return cache()->rememberForever('listings', static function()
        {
            $listings = Listing::query()->withCount(['votes', 'clicks'])->with(['mode', 'tags'])->get();

            return $listings->values()
                ->sortByDesc(static function(Listing $listing) {
                    return $listing->points;
                })->each(static function (Listing $listing, int $key) {
                    $listing->setAttribute('rank', $key + 1);
                    $listing->setAttribute('type', $listing->expRateTitle);
                });
        });
    }
}
