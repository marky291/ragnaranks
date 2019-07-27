<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\Http\Request;
use App\Jobs\AssignRoleToUser;
use Illuminate\Http\JsonResponse;
use App\Listings\ListingVotedEvent;
use TimeHunter\LaravelGoogleReCaptchaV3\Facades\GoogleReCaptchaV3;

class VoteController extends Controller
{
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
            $this->processVote($listing, $captcha);
        }

        return response()->json([
            'success' => false,
            'captcha' => $captcha->toArray(),
        ]);
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

            ListingVotedEvent::dispatch($listing);

            if (auth()->check() && auth()->user()->hasRole('player') == false) {
                AssignRoleToUser::dispatch(auth()->user(), 'player');
            }

            return response()->json([
                'success' => true,
                'redirect' => route('listing.show', $listing),
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
