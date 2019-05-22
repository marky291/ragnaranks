<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCommentRequest;
use App\Interactions\Review;
use App\ReviewComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $comment = ReviewComment::make($request->validated());

        $reviewComment = $review->comments()->save($comment);

        return response()->json(['comment' => $reviewComment], 200);
    }
}
