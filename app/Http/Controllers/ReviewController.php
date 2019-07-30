<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Http\Request;
use App\Jobs\AssignRoleToUser;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Notifications\ReviewPublished;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     *
     * @param ReviewRequest $request
     * @return JsonResponse
     */
    public function store(Listing $listing, ReviewRequest $request): JsonResponse
    {
        if ($listing->reviews()->where('user_id', auth()->id())->count() == false) {
            $review = $listing->reviews()->create($request->validated());

            $listing->user->notify(new ReviewPublished($listing));

            if (auth()->user()->hasRole('player') == false) {
                AssignRoleToUser::dispatch(auth()->user(), 'player');
            }

            return response()->json(['success' => true, 'message' => trans('review.creation.success'), 'review' => $review->load(['user', 'comments'])]);
        }

        return response()->json(['success' => false, 'message' => trans('review.creation.errors.present')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Listing $listing
     * @param Review $review
     * @return RedirectResponse
     */
    public function update(Request $request, Listing $listing, Review $review)
    {
        $listing->reviews->find($review->id)->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Listing $listing
     * @param Review $review
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Listing $listing, Review $review)
    {
        $listing->reviews->find($review->id)->delete();

        return redirect()->back();
    }
}
