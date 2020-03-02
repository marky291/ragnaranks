<?php

namespace App\Http\Controllers;

use App\Listings\Clicks\WebsiteWasClicked;
use App\Listings\Events\Clicked;
use App\Listings\Listing;
use App\Listings\ListingRanking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ListingClickController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     *
     * @return JsonResponse
     */
    public function store(Listing $listing): JsonResponse
    {
        return $this->processClick($listing);
    }

    /**
     * Process an incoming click.
     *
     * @param Listing $listing
     * @return JsonResponse
     */
    public function processClick(Listing $listing)
    {
        if ($listing->clicks()->hasInteractedDuring(config('action.click.spread')) === false)
        {
            $listing->clicks()->create(['ip_address' => request()->getClientIp()]);

            Cache::forget("listing.{$listing->name}");

            ListingRanking::incrementClick($listing);

            Clicked::dispatch($listing);

            return response()->json([], 200);
        }

        return response()->json([],503);
    }
}
