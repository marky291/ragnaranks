<?php

namespace App\Http\Controllers;

use App\Reviews\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ReviewReportRequest;

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
