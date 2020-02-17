<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterMetamorphosis
 *
 * @property int $monster_id
 * @property int $id
 * @property int $amount
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array_merge)
 */
class MonsterMetamorphosis extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_metamorphosis';

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
        'amount',
    ];
}
