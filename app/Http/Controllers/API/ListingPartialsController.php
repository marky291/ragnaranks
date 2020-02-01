<?php

namespace App\Http\Controllers\API;

use App\Listings\Listing;
use App\Listings\Reviews\Review;
use Illuminate\Support\Facades\Cache;

class ListingPartialsController
{
    /**
     * @return mixed
     */
    public function latestServers()
    {
        return Cache::remember('partials.latest-servers', now()->addSeconds(60), static function() {
            return view('sidebar._latest_servers', [
                'listings' => Listing::latest()->with('configuration')->orderBy('created_at')->limit(5)->get()
            ])->render();
        });
    }

    /**
     * @return mixed
     */
    public function latestReviews()
    {
        return Cache::remember('partials.latest-reviews', now()->addSeconds(60), static function() {
            return view('sidebar._latest-reviews', [
                'reviews' => Review::has('listing')->latest()->with(['listing', 'user'])->orderBy('created_at')->limit(5)->get()
            ])->render();
        });
    }
}
