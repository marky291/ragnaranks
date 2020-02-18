<?php


namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use App\Emulator\Items\Resources\ItemBrowsingResource;
use App\Emulator\Monsters\Monster;
use App\Http\Controllers\Controller;
use App\Http\Resources\MonsterResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BrowserQueryController extends Controller
{
    public function index(Request $request)
    {
        if ($this->category($request, 'items')) {
            return $this->queryItemDatabase($request);
        }

        if ($this->category($request, 'monsters')) {
            return $this->queryMonsterDatabase($request);
        }
    }

    private function category(Request $request, string $category) {
        return $request->category == $category;
    }

    private function queryItemDatabase(Request $request)
    {
        // mode     - renewal/pre
        // category - items/mobs
        // type     - item type
        // element  - matches element
        // search   - user input

        // generate a query starting point.
        $items = Item::query();

        // search filtering.
        if ($request->get('search') !== '') {
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
            } else if ($request->sorting == 'zeny') {
                $items->with(['supply' => function ($supply) {
                    $supply->orderBy('price', 'desc');
                }]);
            } else {
                $items->orderBy($request->sorting);
            }
        }

        // return resource collection with pagination.
        return ItemBrowsingResource::collection($items->paginate(12));
    }

    private function queryMonsterDatabase(Request $request) {
        
        // create a query
        $monsters = Monster::query();

        if ($request->get('race') !== 'all') {
            $monsters->whereHas('stats', function(Builder $query) use ($request) {
                $query->where('race', '=', $request->race);
            });
        }

        if ($request->get('search') !== 'all') {
            $monsters->where('name', 'like', "%{$request->search}%");
        }

        return MonsterResource::collection($monsters->paginate(12));
    }
}
