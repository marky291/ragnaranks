<?php


namespace App\Emulator\Monsters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterStats
 *
 * @property int monster_id
 * @property int attackRange
 * @property int level
 * @property int health
 * @property int sp
 * @property int str
 * @property int int
 * @property int vit
 * @property int dex
 * @property int agi
 * @property int luk
 * @property int rechargeTime
 * @property int atk1
 * @property int atk2
 * @property int attack
 * @property int magicAttack
 * @property int defense
 * @property int baseExperience
 * @property int jobExperience
 * @property int aggroRange
 * @property int escapeRange
 * @property int movementSpeed
 * @property int attackSpeed
 * @property int attackedSpeed
 * @property int element
 * @property int scale
 * @property int race
 * @property int magicDefense
 * @property int hit
 * @property int flee
 * @property int ai
 * @property int mvp
 * @property int class
 * @property int attr
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array, $stats)
 */
class MonsterStats extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'attackRange',
        'level',
        'health',
        'sp',
        'str',
        'int',
        'vit',
        'dex',
        'agi',
        'luk',
        'rechargeTime',
        'atk1',
        'atk2',
        'attack',
        'magicAttack',
        'defense',
        'baseExperience',
        'jobExperience',
        'aggroRange',
        'escapeRange',
        'movementSpeed',
        'attackSpeed',
        'attackedSpeed',
        'element',
        'scale',
        'race',
        'magicDefense',
        'hit',
        'flee',
        'ai',
        'mvp',
        'class',
        'attr',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attack' => 'array',
        'magicAttack' => 'array',
    ];
}
