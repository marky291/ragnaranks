<?php

namespace App\Http\Controllers;

use App\Events\Viewed;
use App\Emulator\Items\Item;
use App\Emulator\Monsters\Monster;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class BrowserController extends Controller
{
    public function index()
    {
        return view('emulator.index.');
    }

    public function item(Item $item)
    {
        Event::dispatch(new Viewed($item));

        return view('emulator.item', [
            'item_slug' => $item->slug,
            'item_partial_cache' => Cache::get("partials.item.{$item->slug}"),
        ]);
    }

    public function monster(Monster $monster)
    {
        Event::dispatch(new Viewed($monster));
        
        return view('emulator.monster', ['monster' => $monster, 'properties' => $monster->properties->elements()]);
    }
}
