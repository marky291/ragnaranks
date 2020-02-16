<?php

namespace App\Http\Controllers;

use App\Emulator\Items\Item;
use Illuminate\Support\Facades\Cache;

class BrowserController extends Controller
{
    public function index()
    {
        return view('emulator.browser');
    }

    public function show(string $slug)
    {
        return view('emulator.viewer', ['item_slug' => $slug]);
    }
}
