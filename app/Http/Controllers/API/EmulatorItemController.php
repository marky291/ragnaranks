<?php


namespace App\Http\Controllers\API;


use App\Emulator\Items\Item;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class EmulatorItemController extends Controller
{
    public function overview(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._item', ['item' => Item::where('slug', $item_slug)->first()])->render();
        });
    }

    public function farming(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.farming", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._farming', ['item' => Item::with(['drops.monster.spawns', 'drops.monster.properties'])->whereSlug($item_slug)->first()])->render();
        });
    }

    public function sellers(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.sellers", now()->addSeconds(1), static function() use ($item_slug) {
            $supplies = Item::whereSlug($item_slug)->first()->supply()->with('npc.map')->get();
            return view('emulator.item._sellers', ['supplies' => $supplies])->render();
        });
    }

    public function contents(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.contents", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._contents', ['item' => Item::with('contains.item')->whereSlug($item_slug)->first()])->render();
        });
    }

    public function containers(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.containers", now()->addSeconds(1), static function() use ($item_slug) {
            return view('emulator.item._containers', ['item' => Item::with('containers')->whereSlug($item_slug)->first()])->render();
        });
    }

    public function monsters(string $item_slug)
    {
        return Cache::remember("partials.item.{$item_slug}.monsters", now()->addSeconds(1), static function() use ($item_slug) {
            $drops = Item::whereSlug($item_slug)->first()->drops()->with('monster')->get();
            return view('emulator.item._monsters', ['drops' => $drops])->render();
        });
    }
}
