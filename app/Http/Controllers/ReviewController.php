<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Listings\Reviews\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Class ReviewController
 *
 * @depreciated unused file, moved to ListingReviewController
 *
 * @package App\Http\Controllers
 */
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
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
