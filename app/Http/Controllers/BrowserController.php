<?php

namespace App\Http\Controllers;

use App\Emulator\Items\Item;
use App\Emulator\Monsters\Monster;
use Illuminate\Support\Facades\Cache;

class BrowserController extends Controller
{
    public function index()
    {
        return view('emulator.browser');
    }

    public function item(string $slug)
    {
        return view('emulator.item-viewer', ['item_slug' => $slug]);
    }

    public function monster(Monster $monster)
    {
        return view('emulator.monster-viewer', ['monster' => $monster, 'properties' => $monster->properties->elements()]);
    }
}
