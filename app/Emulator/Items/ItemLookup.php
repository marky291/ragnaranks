<?php

namespace App\Emulator\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemLookup
 *
 * @property int $id
 *
 * @package App
 */
class ItemLookup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_item_lookup';
}
