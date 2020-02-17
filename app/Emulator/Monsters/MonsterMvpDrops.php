<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterMvpDrops
 *
 * @property int $monster_id
 * @property int $item_id
 * @property int $chance
 * @property int $stealProtected
 * @property string $serverTypeName
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array, $drop)
 */
class MonsterMvpDrops extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_mvp_drops';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'item_id',
        'chance',
        'stealProtected',
        'serverTypeName',
    ];
}
