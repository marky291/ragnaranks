<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Notifications\ReportedReviewAllowed;
use App\Notifications\ReportedReviewRemoved;

class ReportController extends Controller
{
    public function index()
    {
        return view('account.moderation', ['reports' => Report::latest()->with(['reporter', 'reportable'])->get()]);
    }

    public function update(Request $request, Report $report) : JsonResponse
    {
        $report->reporter->notify(new ReportedReviewAllowed($report));

        return response()->json([], 200);
    }

    public function destroy(Report $report)
    {
        $report->reportable->delete();

        $report->reporter->notify(new ReportedReviewRemoved($report));

        return response()->json([], 200);
    }
}
