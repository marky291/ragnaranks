<?php


namespace App\Http\Controllers\API;


use App\Emulator\Items\Item;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class EmulatorItemController extends Controller
{
    public function overview(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._item', ['item' => Item::where('slug', $item_slug)->first()])->render();
        });
    }

    public function droppers(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.droppers", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._droppers', ['item' => Item::with(['drops.monster.spawns', 'drops.monster.properties'])->whereSlug($item_slug)->first()])->render();
        });
    }

    public function sellers(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.sellers", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._sellers', ['item' => Item::with('sellers')->whereSlug($item_slug)->first()])->render();
        });
    }
}
