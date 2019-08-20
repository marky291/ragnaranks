<?php

namespace App\Listings;

use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ListingResource;

class ListingRepository
{
    public static function LatestEntriesCache(int $count)
    {
        return Cache::remember('listing:latest-entries', 300, static function () use ($count) {
            return ListingResource::collection(Listing::latest()->orderBy('created_at')->limit($count)->get());
        });
    }
}
