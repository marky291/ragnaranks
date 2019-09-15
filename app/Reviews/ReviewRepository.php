<?php

namespace App\Reviews;

use App\Http\Resources\ListingResource;
use App\Http\Resources\ReviewResource;
use App\Interactions\Review;
use App\Listings\Listing;
use Illuminate\Support\Facades\Cache;

class ReviewRepository
{
    public static function LatestEntriesCache(int $count)
    {
        return Cache::remember('reviews:latest-entries', 300, static function () use ($count) {
            return ReviewResource::collection(Review::latest()->with('listing')->orderBy('created_at')->limit($count)->get());
        });
    }
}
