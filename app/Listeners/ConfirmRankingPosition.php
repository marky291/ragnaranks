<?php

namespace App\Listeners;

use App\Listings\ListingRanking;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ConfirmRankingPosition.
 */
class ConfirmRankingPosition implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event): void
    {
        $this->recursiveGain($event->listing->ranking);
    }

    private function recursiveGain(ListingRanking $listing): void
    {
        // We dont care if its already rank 1.
        if ($listing->rank == 1) {
            return;
        }

        /** @var ListingRanking $next */
        $next = ListingRanking::query()->where('rank', $listing->rank - 1)->first();

        if ($listing->points < $next->points) {
            return;
        }

        // this shit dont care if you guys have the same points
        if ($listing->points == $next->points) {
            return;
        }

        $swap = $next->rank;

        DB::transaction(static function () use ($listing, $next, $swap) {
            // first we update the next ranked to the current lower rank
            ListingRanking::query()->where('rank', $listing->rank)->update(['rank' => 0]);

            // then we use the swap value to store the next rank to the current.
            ListingRanking::query()->where('rank', $next->rank)->update(['rank' => $listing->rank]);

            // next we swap the rank back to the new position
            ListingRanking::query()->where('rank', 0)->update(['rank' => $swap]);
        }, 5);

        // we should look around, in case another listing is in front with less points.
        $this->recursiveGain($listing);
    }
}
