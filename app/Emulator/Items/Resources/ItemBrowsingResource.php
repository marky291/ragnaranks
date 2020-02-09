<?php

namespace App\Emulator\Items\Resources;

use App\Emulator\Items\Item;
use App\Emulator\Items\ItemContains;
use App\Emulator\Monsters\MonsterDrops;
use App\Emulator\Npcs\Npc;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int id
 * @property string aegisName
 * @property string name
 * @property string description
 * @property int slots
 * @property int setname
 * @property int itemTypeId
 * @property int itemSubTypeId
 * @property int attack
 * @property int defence
 * @property int weight
 * @property int requiredLevel
 * @property int limitLevel
 * @property int weaponLevel
 * @property int job
 * @property int compositionPos
 * @property int attribute
 * @property int location
 * @property int price
 * @property int range
 * @property int matk
 * @property int gender
 * @property int refinable
 * @property int indestructible
 * @property int cardPrefix
 *
 * @property MonsterDrops|Collection drops
 * @property ItemContains|Collection containers
 * @property Npc|Collection sellers
 */
class ItemBrowsingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'route' => $this->route,
            'script' => $this->script,
            'subType' => $this->subType,
            'type' => $this->type,
            'buy' => 0,
            'weight' => $this->weight,
            'sell' => $this->price,
            'description' => $this->description,
            'monsterCount' => optional($this->drops)->count() ?? 0,
            'merchantCount' => optional($this->sellers)->count() ?? 0,
            'containerCount' =>optional( $this->containers)->count() ?? 0,
            'icon' => $this->icon,
        ];
    }
}
