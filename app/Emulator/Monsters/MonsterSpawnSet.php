<?php


namespace App\Emulator\Monsters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterSpawnSet
 *
 * @property int $monster_id
 * @property int $id
 * @property int $type
 * @property int $amount
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array, $spawnset)
 */
class MonsterSpawnSet extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_spawn_set';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'id',
        'type',
        'amount',
    ];

}
