<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterSkills
 *
 * @property int $monster_id
 * @property int $idx
 * @property int $skillId
 * @property int $status
 * @property int $level
 * @property int $chance
 * @property int $casttime
 * @property int $delay
 * @property int $interruptable
 * @property int $changeTo
 * @property int $condition
 * @property int $conditionValue
 * @property int $sendType
 * @property int $sendValue
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array_merge)
 */
class MonsterSkills extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_skills';

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
        'idx',
        'skillId',
        'status',
        'level',
        'chance',
        'casttime',
        'delay',
        'interruptable',
        'changeTo',
        'condition',
        'conditionValue',
        'sendType',
        'sendValue',
    ];
}
