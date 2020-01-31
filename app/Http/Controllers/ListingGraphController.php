<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\Http\Request;

class ListingGraphController extends Controller
{
    public function index(Listing $listing)
    {
        $listing = cache()->remember("listing.graphs.{$listing->name}", 60, function() use ($listing) {
            return $listing->load(['heartbeat', 'site'])->loadCount(['votes', 'clicks', 'reviews']);
        });

        return view('listing.graphs.index', compact('listing'));
    }
}
