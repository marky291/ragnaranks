<?php

namespace App\Emulator\Items\Resources;

use App\Emulator\Items\ItemContains;
use App\Emulator\Items\ItemSupply;
use App\Emulator\Monsters\MonsterDrops;
use App\Emulator\DivinePrideEnumConverter;
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
 * @property ItemSupply|Collection supply
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
            'icon' => $this->icon,
            'script' => $this->script,
            'type' => DivinePrideEnumConverter::ItemTypeId($this->itemTypeId),
            'subType' => DivinePrideEnumConverter::ItemSubTypeId($this->itemSubTypeId),
            'location' => DivinePrideEnumConverter::LocationId($this->location, $this->itemTypeId + $this->itemSubTypeId),
            'composition' => DivinePrideEnumConverter::CompositionId($this->compositionPos),
            'weight' => $this->weight,
            'buy' => 0,
            'sell' => $this->price,
            'description' => $this->description,
            'monsterCount' => $this->drops()->count(),
            'merchantCount' => $this->supply()->count(),
            'containerCount' =>$this->containers()->count(),
        ];
    }
}
