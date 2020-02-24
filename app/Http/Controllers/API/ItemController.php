<?php

namespace App\Http\Controllers\API;

use App\Emulator\Items\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function partial(string $slug)
    {
        return cache()->remember("partials.item.{$slug}", now()->addMinutes(5), static function() use ($slug) 
        {
            $item = Item::with(['drops.monster.spawns', 'drops.monster.properties', 'supply.npc.map', 'contains.item', 'containers.source'])->whereSlug($slug)->first();

            return view('emulator._item-loaded', [
                'item' => $item
            ])->render();
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
