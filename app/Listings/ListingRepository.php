<?php


namespace App\Listings;


use App\Http\Resources\ListingResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class ListingRepository
{
    public static function LatestEntriesCache(int $count)
    {
        return Cache::remember('listing:latest-entries', 30, static function() use ($count) {
            return ListingResource::collection(Listing::orderBy('created_at')->limit($count)->get());
        });
    }
}