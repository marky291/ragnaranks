<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewReportRequest;
use App\Interactions\Review;
use App\Notifications\ReviewWasReported;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Review $review
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Review $review, ReviewReportRequest $request): JsonResponse
    {
        $review = $review->report($request->validated(), auth()->user());

        $status = $review->save();

        return response()->json(['status' => $status], 200);
    }
}
