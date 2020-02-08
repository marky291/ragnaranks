<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterSounds
 *
 * @property int $monster_id
 * @property string $filename
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array)
 */
class MonsterSounds extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_sounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'filename',
    ];
}
