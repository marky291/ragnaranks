<?php

namespace App\Http\Controllers;

use App\Reviews\Review;
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
        if ($review->comments()->count() == 0) {
            $reviewComment = $review->comments()->create($request->validated());

            $review->user->notify(new ReviewCommentPublished($review));

            return response()->json(['success' => true, 'comment' => $reviewComment]);
        }

        return response()->json(['success' => false, 'message' => trans('review.comments.errors.exists')]);
    }
}
