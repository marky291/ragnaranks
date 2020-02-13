<?php


namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use App\Emulator\Items\Resources\ItemBrowsingResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemBrowsingController extends Controller
{
    public function index(Request $request)
    {
        // generate a query starting point.
        $items = Item::query();

        // search filtering.
        if ($request->has('search')) {
            $items->where('name', 'like', "%{$request->search}%");
            $items->orWhere('description', 'like', "%{$request->search}%");
        }

        // return resource collection with pagination.
        return ItemBrowsingResource::collection($items->paginate(12));
    }
}
