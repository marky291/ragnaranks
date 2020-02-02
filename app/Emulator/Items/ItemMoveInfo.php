<?php


namespace App\Emulator\Items;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemMoveInfo
 *
 * @property int $id
 * @property int $item_id
 * @property bool $drop
 * @property bool $trade
 * @property bool $store
 * @property bool $cart
 * @property bool $sell
 * @property bool $mail
 * @property bool $auction
 * @property bool $guildStore
 * @package App\Emulator\Items
 * @method static firstOrCreate(array $array, $itemMoveInfo)
 */
class ItemMoveInfo extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_item_move_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'drop',
        'trade',
        'store',
        'cart',
        'sell',
        'mail',
        'auction',
        'guildStore',
    ];
}
