<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterSlaves
 *
 * @property int $monster_id
 * @property int $id
 * @property int $idx
 * @property int $amount
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array_merge)
 */
class MonsterSlaves extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_slaves';

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
        'id',
        'idx',
        'amount',
    ];
}
