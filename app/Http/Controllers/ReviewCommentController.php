<?php

namespace App\Http\Controllers;

use App\Interactions\Review;
use Illuminate\Http\Response;
use App\Http\Requests\ReviewCommentRequest;
use App\Notifications\ReviewCommentPublished;

class ReviewCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Review $review
     * @param ReviewCommentRequest $request
     * @return void
     */
    public function store(Review $review, ReviewCommentRequest $request)
    {
        $reviewComment = $review->comments()->create($request->validated());

        $review->publisher->notify(new ReviewCommentPublished($review));

        return response()->json(['comment' => $reviewComment], 200);
    }
}
