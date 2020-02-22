<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Listings\Listing;
use App\Listings\Reviews\Review;
use Illuminate\Support\Facades\Cache;

class SidebarController extends Controller
{
    /**
     * @return mixed
     */
    public function servers()
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
    public function reviews()
    {
        return Cache::remember('partials.latest-reviews', now()->addSeconds(60), static function() {
            return view('sidebar._latest-reviews', [
                'reviews' => Review::has('listing')->latest()->with(['listing', 'user'])->orderBy('created_at')->limit(5)->get()
            ])->render();
        });
    }
}
