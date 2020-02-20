<?php

namespace App\Http\Controllers;

use App\Emulator\Items\Events\ViewedBrowserItem;
use App\Emulator\Items\Item;
use App\Emulator\Monsters\Monster;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class BrowserController extends Controller
{
    public function index()
    {
        return view('emulator.browser');
    }

    public function item(Item $item)
    {
        Event::dispatch(new ViewedBrowserItem($item));

        return view('emulator.item-viewer', ['item_slug' => $item->slug]);
    }

    public function monster(Monster $monster)
    {
        return view('emulator.monster-viewer', ['monster' => $monster, 'properties' => $monster->properties->elements()]);
    }
}
