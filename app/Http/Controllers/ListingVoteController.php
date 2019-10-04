<?php

namespace App\Http\Controllers;

use App\Jobs\AssignRoleToUser;
use App\Listings\Listing;
use App\Listings\ListingRanking;
use App\Listings\ListingVotedEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use TimeHunter\LaravelGoogleReCaptchaV3\Facades\GoogleReCaptchaV3;

class ListingVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Listing $listing
     * @return Response
     */
    public function index(Listing $listing)
    {
       return view('listing.vote.index', ['listing' => $listing]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Listing $listing
     * @return JsonResponse
     */
    public function store(Request $request, Listing $listing): JsonResponse
    {
        $captcha = GoogleReCaptchaV3::setAction('vote')->verifyResponse($request->get('captchaV3'), $request->getClientIp());

        if ($captcha->isSuccess()) {
            return $this->processVote($listing, $captcha);
        }

        return response()->json([], 503);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Public allows API Access to auto vote.
     *
     * @param Listing $listing
     * @param null $captcha
     * @return JsonResponse
     */
    public function processVote(Listing $listing, $captcha = null)
    {
        if ($listing->votes()->hasInteractedDuring(config('action.vote.spread')) === false) {
            $listing->votes()->create(['ip_address' => request()->getClientIp()]);

            ListingRanking::incrementVote($listing);

            ListingVotedEvent::dispatch($listing);

            AssignRoleToUser::dispatch(auth()->user(), 'player');

            return response()->json([
                'success' => true,
                'redirect' => route('listing.votes.index', $listing),
                'captcha' => $captcha,
            ]);
        }

        return response()->json([
            'success' => false,
            'redirect' => route('listing.show', $listing),
            'captcha' => $captcha,
            'message' => trans('profile.voting.declined', ['hours' => config('action.vote.spread')]),
        ]);
    }
}
