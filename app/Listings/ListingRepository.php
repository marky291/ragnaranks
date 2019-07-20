<?php

namespace App\Listings;

use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ListingResource;

class ListingRepository
{
    public static function LatestEntriesCache(int $count)
    {
        return Cache::remember('listing:latest-entries', now()->addMinutes(10), static function () use ($count) {
            return ListingResource::collection(Listing::orderBy('created_at')->limit($count)->get());
        });
    }
}
