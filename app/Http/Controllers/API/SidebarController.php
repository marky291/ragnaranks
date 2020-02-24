<?php

namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Listings\Listing;
use App\Listings\Reviews\Review;
use App\Viewable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class SidebarController extends Controller
{
    /**
     * @return mixed
     */
    public function servers()
    {
        return Cache::remember('partials.latest-servers', now()->addMinutes(5), static function() {
            return view('sidebar.latest.listings', [
                'listings' => Listing::latest()->with('configuration')->orderBy('created_at')->limit(5)->get()
            ])->render();
        });
    }

    /**
     * @return mixed
     */
    public function reviews()
    {
        return Cache::remember('partials.latest-reviews', now()->addMinutes(5), static function() {
            return view('sidebar.latest.reviews', [
                'reviews' => Review::has('listing')->latest()->with(['listing', 'user'])->orderBy('created_at')->limit(5)->get()
            ])->render();
        });
    }

    public function trendingItems()
    {
        return Cache::remember('partials.itemIcons', now()->addMinutes(5), static function() {
            return view('sidebar.trending._item-icons', [
                'viewable' => Viewable::whereHasMorph('viewable', Item::class)->take(12)->get(),
            ])->render();
        });
    }
}
