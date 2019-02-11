<?php

namespace App\Http\Controllers;

use App\Interactions\Vote;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

        if (!$listing->votes()->hasClientInteractedWith($spread))
        {
            $listing->votes()->create(['ip_address' => request()->getClientIp()]);
        }

        if ($request->expectsJson())
        {
            return;
        }

        redirect()->back()->with(["flash" => "You can only vote every {$spread} hours."]);
    }
}
