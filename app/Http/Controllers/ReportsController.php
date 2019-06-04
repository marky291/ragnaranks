<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('account.moderation', ['reports' => Report::latest()->with(['reporter', 'reportable'])->get()]);
    }
}
