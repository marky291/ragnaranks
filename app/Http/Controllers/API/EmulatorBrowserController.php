<?php


namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use App\Emulator\Items\Resources\ItemBrowsingResource;
use App\Emulator\Monsters\MonsterDrops;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use App\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmulatorBrowserController extends Controller
{
    public function index(Item $item)
    {
        $text = request()->get('search', '');

        if ($text) {
            $results = Item::where('name', 'like', "%{$text}%");
        }

        return ItemBrowsingResource::collection($results->paginate(12));
    }
}
