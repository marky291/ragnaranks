<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ListingClickMetricController extends Controller
{
    public function monthly(Listing $listing)
    {
        /** @var Collection $result */
        $result = $listing->clicks()->rankingTimeframe()->countPerDay()->get();

        foreach ($result as $key => $item) {
            $result[$key]->day = Carbon::parse($item->date)->format('jS');
        }

        return $result->pluck('total', 'day');
    }
}
