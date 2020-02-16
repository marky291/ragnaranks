<?php


namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use App\Emulator\Items\Resources\ItemBrowsingResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrowserQueryController extends Controller
{
    public function index(Request $request)
    {

        // mode     - renewal/pre
        // category - items/mobs
        // type     - item type
        // element  - matches element
        // search   - user input

        if ($request->category == 'items')
        {
            // generate a query starting point.
            $items = Item::query();

            // search filtering.
            if ($request->get('search') !== 'all') {
                $items->where('name', 'like', "%{$request->search}%");
                $items->orWhere('description', 'like', "%{$request->search}%");
            }

            if ($request->get('type') !== 'all') {
                $items->where('type', $request->type);
            }

            if ($request->get('subtype') !== 'all') {
                $items->where('subtype', $request->subtype);
            }

            if ($request->get('element') !== 'all') {
                $items->where('element', $request->element);
            }

            if ($request->has('sorting')) {
                if ($request->sorting == 'slots') {
                    $items->orderByDesc($request->sorting);
                } else {
                    $items->orderBy($request->sorting);
                }
            }

            // return resource collection with pagination.
            return ItemBrowsingResource::collection($items->paginate(12));
        }
    }
}
