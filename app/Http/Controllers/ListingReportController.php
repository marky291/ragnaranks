<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\Http\Request;

class ListingReportController extends Controller
{
    public function index(Listing $listing)
    {
        return view('listing.report.index', [
            'listing' => $listing->load('heartbeat')
        ]);
    }
}
