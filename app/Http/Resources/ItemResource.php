<?php

namespace App\Http\Resources;

use App\Databases\Items\ItemEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name_english
 * @property string $name_japanese
 * @property int $type
 * @property int $price_buy
 * @property int $price_sell
 * @property int $weight
 * @property int $attack
 * @property int $defence
 * @property int $range
 * @property int $slot
 * @property int $equip_jobs
 * @property int $equip_upper
 * @property int $equip_genders
 * @property int $equip_location
 * @property int $weapon_level
 * @property int $equip_level
 * @property int $refinable
 * @property int $view
 * @property string $script
 * @property string $equip_script
 * @property string $unequip_script
 */
class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name_english,
            'type' => ItemEnum::TypeValueToString($this->type),
            'slots' => $this->slot,
        ];
    }
}
