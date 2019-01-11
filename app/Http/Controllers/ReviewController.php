<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Listings\Listing;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     * @param Listing $listing
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReviewRequest $request, Listing $listing)
    {
        $listing->reviews()->create($request->validated());

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
