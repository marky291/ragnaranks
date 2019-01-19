<?php

namespace App\Http\Controllers;

use App\Interactions\Vote;
use App\Interactions\VoteInteractionJob;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     */
    public function store(Listing $listing)
    {
        if (Vote::hasNotInteractedWith(6))
        {
            $listing->votes()->create(['ip_address' => request()->getClientIp()]);
        }

        redirect()->back()->with(['flash' => 'You can only vote every 6 hours.']);
    }
}
