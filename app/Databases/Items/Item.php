<?php

namespace App\Databases\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
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
 *
 * @package App\Databases\Items
 */
class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_db';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
