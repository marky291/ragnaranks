<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListingSearchController extends Controller
{
    public function index(Request $request)
    {
        $textToSearch = $request->query('query');

        $results = Cache::remember("query:{$textToSearch}", now()->addMinutes(10), static function() use ($textToSearch) {
            return Listing::where('name', 'like', "%$textToSearch%")->with(['configuration', 'tags', 'ranking', 'language', 'heartbeat'])->paginate(7);
        });

        return ListingResource::collection($results);
    }
}
