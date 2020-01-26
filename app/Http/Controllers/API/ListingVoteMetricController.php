<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interactions\Vote;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ListingVoteMetricController
 *
 * @package App\Http\Controllers
 */
class ListingVoteMetricController extends Controller
{
    public function monthly(Listing $listing)
    {
        /** @var Collection $result */
        $result = $listing->votes()->days(30)->countPerDay()->get();

        foreach ($result as $key => $item) {
            $result[$key]->day = Carbon::parse($item->date)->format('jS');
        }

        return $result->pluck('total', 'day');
    }
}
