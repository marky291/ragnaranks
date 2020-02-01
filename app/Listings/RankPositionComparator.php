<?php

namespace App\Listings;

use App\Ranking\InvalidRankPositionException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ConfirmRankingPosition.
 */
class RankPositionComparator implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     *
     * @throws \Exception
     */
    public function handle($event): void
    {
        $this->sortListingPosition($event->listing);

        cache()->forget("listing:{$event->listing->name}");
    }

    /**
     * Recursively upgrade the position if it has more points than the next listing.
     *
     * @param Listing $listing
     * @throws InvalidRankPositionException
     */
    private function sortListingPosition(Listing $listing): void
    {
        // We dont care if its already rank 1.
        if ($listing->ranking->rank == 1) {
            return;
        }

        // what are we comparing this listing against.
        do {
            /** @var ListingRanking $compare **/
            $compare = ListingRanking::where('rank', $listing->ranking->rank - 1)->whereHas('listing')->first();

            // fill the void if we the rank position is empty.
            if (!isset($compare)) {
                $listing->ranking->rank--;
            }

            // we dont allow negative rankings.
            if ($listing->ranking->rank <= 0) {
                throw new InvalidRankPositionException("Negative rank position found {$listing->ranking->rank}");
            }
        }
        while ($compare == null);

        // we dont need to move if we dont have more points.
        if ($listing->ranking->points < $compare->points) {
            return;
        }

        // this shit dont care if you guys have the same points
        if ($listing->ranking->points == $compare->points) {
            return;
        }

        $swap = $compare->rank;

        // first we update the next ranked to the current lower rank
        // then we use the swap value to store the next rank to the current.
        $compare->update(['rank' => $listing->ranking->rank]);

        // next we swap the rank back to the new position
        $listing->ranking->update(['rank' => $swap]);

        // we should look around, in case another listing is in front with less points.
        $this->sortListingPosition($listing);
    }
}
