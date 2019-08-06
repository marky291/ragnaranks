<?php

namespace App\Listings;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReconditionListingSpace implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

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
        $this->conditionBackground($this->listing);
    }

    /**
     * Check if the attribute contains a temporary file path location.
     *
     * @param string $path
     * @return bool
     */
    private function containsTempFile(string $path): bool
    {
        return Str::contains($path,'tmp');
    }

    /**
     * Condition the background from its temporary location to its space location.
     *
     * @param Listing $listing
     */
    private function conditionBackground(Listing $listing): void
    {
        if ($this->containsTempFile($listing->background))
        {
            // naming for the background iamge.
            $newStorageLoc = "{$listing->space}/background.jpg";

            // Delete file if already exists in the new location.
            if (Storage::exists($newStorageLoc)) {
                Storage::delete($newStorageLoc);
            }

            // Move the new file to the location
            if (Storage::move($listing->background, $newStorageLoc)) {
                $listing->update(['background' => $newStorageLoc]);
            }
        }
    }
}
