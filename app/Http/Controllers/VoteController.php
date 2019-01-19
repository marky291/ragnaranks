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
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Listing $listing)
    {
        $this->authorize('vote', $listing);

        $listing->votes()->create(['ip_address' => request()->getClientIp()]);
    }
}
