<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Interactions\Interaction;
use App\Interactions\Vote;
use App\Listings\Listing;
use App\Interactions\Review;
use App\Notifications\ReviewPublished;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $review = $listing->reviews()->create($request->validated());

        $listing->user->notify(new ReviewPublished($listing));

        return response()->json(['review' => $review], 200);
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
