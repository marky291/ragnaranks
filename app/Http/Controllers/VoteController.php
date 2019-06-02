<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use App\Interactions\Vote;
use Illuminate\Http\Request;
use App\Jobs\AssignRoleToMember;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     */
    public function store(Request $request, Listing $listing)
    {
        $spread = config('interaction.vote.spread');

        if (! $listing->votes()->hasClientInteractedWith($spread)) {
            $listing->votes()->create(['ip_address' => request()->getClientIp()]);
        }

        if ($request->expectsJson()) {
            return;
        }

        // AssignRoleToMember::dispatch(auth()->user(), 'player');

        redirect()->back()->with(['flash' => "You can only vote every {$spread} hours."]);
    }
}
