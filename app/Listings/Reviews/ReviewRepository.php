<?php

namespace App\Listings\Reviews;

use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ReviewResource;

class ReviewRepository
{
    public static function LatestEntriesCache(int $count)
    {
        return Cache::remember('reviews:latest-entries', 60, static function () use ($count) {
            return ReviewResource::collection(Review::has('listing')->latest()->with(['listing', 'user'])->orderBy('created_at')->limit($count)->get());        });
    }
}
