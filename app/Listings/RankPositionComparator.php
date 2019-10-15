<?php

namespace App\Listings;

use App\Listings\ListingRanking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
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
        $this->sortListingPosition($event->listing->ranking);

        cache()->forget("listing:{$event->listing->name}");
    }

    /**
     * Recursively upgrade the position if it has more points than the next listing.
     *
     * @param \App\Listings\ListingRanking $listing
     */
    private function sortListingPosition(ListingRanking $listing): void
    {
        // We dont care if its already rank 1.
        if ($listing->rank == 1) {
            return;
        }

        /** @var ListingRanking $compare */
        $compare = ListingRanking::where('rank', $listing->rank - 1)->first();


        if ($listing->points < $compare->points) {
            return;
        }

        // this shit dont care if you guys have the same points
        if ($listing->points == $compare->points) {
            return;
        }

        $swap = $compare->rank;

        // first we update the next ranked to the current lower rank
        // then we use the swap value to store the next rank to the current.
        $compare->update(['rank' => $listing->rank]);

        // next we swap the rank back to the new position
        $listing->update(['rank' => $swap]);

        // we should look around, in case another listing is in front with less points.
        $this->sortListingPosition($listing);
    }
}
