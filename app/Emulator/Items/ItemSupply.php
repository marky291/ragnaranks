<?php


namespace App\Emulator\Items;

use App\Emulator\Map\MapNpc;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemSeller
 *
 * @property integer $item_id
 * @property integer $npc_id
 * @property integer $price
 *
 * @package App\Emulator\Items
 * @method static firstOrCreate(array $array)
 */
class ItemSupply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_item_soldby';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'npc_id',
        'price',
    ];

    public function npc()
    {
        return $this->belongsTo(MapNpc::class,'npc_id', 'id');
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
