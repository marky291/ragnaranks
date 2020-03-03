<?php

namespace App\Http\Controllers\API;

use App\Jobs\AssignRoleToUser;
use App\Listings\Events\Voted;
use App\Listings\Listing;
use App\Listings\ListingRanking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class Vote4PointsController
 *
 * @package App\Http\Controllers\API
 */
class Vote4PointsController extends Controller
{
    public function index(Request $request, Listing $listing)
    {
        $apiToken = $request->query('api_token');

        if ($listing->votes()->hasInteractedDuring(config('action.vote.spread')) === false) {
            $listing->votes()->create(['ip_address' => request()->getClientIp()]);
            ListingRanking::incrementVote($listing);
            Voted::dispatch($listing);
            AssignRoleToUser::dispatch(auth()->user(), 'player');

            return view('listing.vote.vote4points', ['listing' => $listing, 'status' => true]);
        }

        return view('listing.vote.vote4points', ['listing' => $listing, 'status' => false]);
    }
}
