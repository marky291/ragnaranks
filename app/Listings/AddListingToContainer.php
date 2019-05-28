<?php

namespace App\Listings;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class AddListingToContainer.
 */
class AddListingToContainer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Listing
     */
    private $listing;

    /**
     * Create a new job instance.
     *
     * @param Listing $listing
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (Cache::has('listings')) {
            $this->listing->setAttribute('rank', $this->listing->id);

            Cache::get('listings')->push($this->listing);
        }
    }
}
