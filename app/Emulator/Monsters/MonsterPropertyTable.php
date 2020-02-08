<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterPropertyTable
 *
 * @property int $monster_id
 * @property int $0
 * @property int $1
 * @property int $2
 * @property int $3
 * @property int $4
 * @property int $5
 * @property int $6
 * @property int $7
 * @property int $8
 * @property int $9
 *
 * @method static firstOrCreate(array $array_merge)
 *
 * @package App\Emulator\Monsters
 */
class MonsterPropertyTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
    ];
}
