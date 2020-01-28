<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\Http\Request;

class ListingReportController extends Controller
{
    public function index(Listing $listing)
    {
        $listing = cache()->remember("listing.report.{$listing->name}", 60, function() use ($listing) {
            return $listing->load(['heartbeat', 'site'])->loadCount(['votes', 'clicks', 'reviews']);
        });

        return view('listing.report.index', compact('listing'));
    }
}
