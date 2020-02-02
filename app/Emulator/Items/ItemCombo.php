<?php

namespace App\Emulator\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemSets
 *
 * @property int $id
 * @property string $name
 * @property int $item_id
 * @property int $set_id
 *
 * @package App\Emulator\Items
 */
class ItemCombo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_item_combos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'item_id',
        'set_id',
    ];
}
