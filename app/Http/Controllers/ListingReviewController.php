<?php

namespace App\Http\Controllers;

use Exception;
use App\Reviews\Review;
use Illuminate\View\View;
use App\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\AssignRoleToUser;
use Illuminate\Http\JsonResponse;
use App\Notifications\ReviewPublished;
use App\Http\Requests\ListingReviewRequest;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class ListingReviewController
 *
 * @package App\Http\Controllers
 */
class ListingReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Listing $listing
     * @return View
     */
    public function index(Listing $listing) : View
    {
        return view('listing.review.index')->with([
            'listing' => $listing->load('heartbeat'),
            'reviews' => Review::forListing($listing)->with(['user'])->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Listing $listing
     * @param Review $review
     * @return View
     * @throws AuthorizationException
     */
    public function create(Listing $listing, Review $review): View
    {
        $this->authorize('create', [$review, $listing]);

        return view('listing.review.create')->with([
            'listing' => $listing,
            'review' => $review
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ListingReviewRequest $request
     * @param Listing $listing
     * @return JsonResponse
     * @throws Exception
     */
    public function store(ListingReviewRequest $request, Listing $listing) : JsonResponse
    {
        $this->authorize('create', [new Review, $listing]);

        $review = $listing->reviews()->create($request->validated());

        $listing->user->notify(new ReviewPublished($listing));

        AssignRoleToUser::dispatch(auth()->user(), 'player');

        return response()->json(['route' => route('listing.reviews.index', $listing)]);
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
     * @param Listing $listing
     * @param Review $review
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Listing $listing, Review $review): View
    {
        $this->authorize('update', $review);

        return view('listing.review.create')->with(['listing' => $listing, 'review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ListingReviewRequest $request
     * @param Listing $listing
     * @param Review $review
     * @return Response
     */
    public function update(ListingReviewRequest $request, Listing $listing, Review $review)
    {
        $listing->reviews->find($review->id)->update($request->all());

        return response()->json(['route' => route('listing.reviews.index', $listing)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Listing $listing
     * @param Review $review
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Listing $listing, Review $review): JsonResponse
    {
        $this->authorize('delete', $review);

        $listing->reviews->find($review->id)->delete();

        return response()->json(['route' => route('listing.reviews.index', $listing)]);
    }
}
