<?php

namespace App\Http\Controllers\API;

use App\Listings\Listing;
use App\Http\Controllers\Controller;
use App\Listings\Graphs\GraphHeartbeatFormatter;
use App\Listings\Graphs\GraphInteractionFormatter;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Class ListingGraphController
 *
 * @package App\Http\Controllers
 */
class ListingGraphController extends Controller
{
    /**
     * Get the total vote events for the last 30 days.
     *
     * @param Listing $listing
     * @return SupportCollection
     * @throws AuthorizationException
     */
    public function votes(Listing $listing): SupportCollection
    {
        $this->authorize('analyze', $listing);

        $votes = $listing->votes()->whereRankable()->selectDateTotals()->get();

        return GraphInteractionFormatter::formatTotalWithDates($votes);
    }

    /**
     * Get the total click events for the last 30 days.
     *
     * @param Listing $listing
     * @return SupportCollection
     * @throws AuthorizationException
     */
    public function clicks(Listing $listing): SupportCollection
    {
        $this->authorize('analyze', $listing);

        $clicks = $listing->clicks()->whereRankable()->selectDateTotals()->get();

        return GraphInteractionFormatter::formatTotalWithDates($clicks);
    }

    /**
     * Graph data for players.
     *
     * @param Listing $listing
     * @return SupportCollection
     * @throws AuthorizationException
     */
    public function players(Listing $listing): SupportCollection
    {
        $this->authorize('analyze', $listing);

        $heartbeats = $listing->heartbeats()->createdSinceYesterday()->get();

        return GraphHeartbeatFormatter::groupByCreationMapWithDate($heartbeats);
    }
}
