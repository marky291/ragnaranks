<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterLookup
 *
 * @property int $ID
 *
 * @package App\Emulator\Monsters
 */
class MonsterLookup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_lookup';
}
