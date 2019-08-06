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
        if ($this->containsTempFile($this->listing->background))
        {
            // naming for the background iamge.
            $newStorageLoc = "{$this->listing->space}/background.jpg";

            $this->moveFile($this->listing->background, $newStorageLoc);
        }

        /** @var ListingScreenshot $screenshot */
        foreach ($this->listing->screenshots as $key => $screenshot)
        {
            if ($this->containsTempFile($screenshot->link)) {
                $newLocation = "{$this->listing->space}/screenshot_{$key}.jpg";
                // Delete file if already exists in the new location.
                if (Storage::exists($newLocation)) {
                    Storage::delete($newLocation);
                }

                if (Storage::move($screenshot->link, $newLocation)) {
                    $screenshot->update(['link' => $newLocation]);
                }
            }
        }

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

    private function moveFile(string $oldLocation, string $newLocation)
    {
        // Delete file if already exists in the new location.
        if (Storage::exists($newLocation)) {
            Storage::delete($newLocation);
        }

        // Move the new file to the location
        if (Storage::move($oldLocation, $newLocation)) {
            $this->listing->update(['background' => $newLocation]);
        }
    }


}
