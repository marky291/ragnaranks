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
    public function index()
    {
        $page = request()->get('page', 1);

        return Cache::remember("emulator.browser.items.{$page}", 5, static function() {
            return ItemBrowsingResource::collection(Item::paginate(20));
        });
    }

    public function searchByText(Request $request)
    {
        $textToSearch = $request->query('query');

        $results = Item::where('name', 'like', "%{$textToSearch}%")->paginate(20);

        return ItemBrowsingResource::collection($results);
    }
}
