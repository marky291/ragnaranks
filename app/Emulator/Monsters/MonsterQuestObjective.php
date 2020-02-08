<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterQuestObjective
 *
 * @property int $monster_id
 * @property int $quest_id
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array)
 */
class MonsterQuestObjective extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_quest_objective';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'quest_id',
    ];
}
