<?php

namespace App\Http\Controllers;

use BrianFaust\Reportable\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('account.moderation', ['reports' => Report::all()]);
    }
}
