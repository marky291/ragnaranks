<?php

namespace App\Emulator\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemLookup
 *
 * @property int $id
 * @property string $script
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
    protected $table = 'item_db_re';
}
