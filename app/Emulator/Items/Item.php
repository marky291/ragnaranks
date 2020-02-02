<?php

namespace App\Emulator\Items;

use App\Emulator\Npcs\Npc;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Item
 *
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
 * @package App\Emulator\Items
 * @method static updateOrInsert(array $array)
 * @method static firstOrCreate(array $array, $decode)
 * @method static|Builder whereId($id)
 */
class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'aegisName',
        'name',
        'description',
        'slots',
        'setname',
        'itemTypeId',
        'itemSubTypeId',
        'attack',
        'defence',
        'weight',
        'requiredLevel',
        'limitLevel',
        'weaponLevel',
        'job',
        'compositionPos',
        'attribute',
        'location',
        'price',
        'range',
        'matk',
        'gender',
        'refinable',
        'indestructible',
        'cardPrefix',
    ];

    /**
     * Item is sold by many NPCS
     */
    public function soldBy()
    {
        return $this->belongsToMany(Npc::class, 'emulator_item_soldby');
    }
}
