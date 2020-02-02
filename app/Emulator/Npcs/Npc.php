<?php


namespace App\Emulator\Npcs;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Npc
 *
 * @property int $id;
 * @property string $name;
 * @property string $mapname;
 * @property int $job;
 * @property int $x;
 * @property int $y;
 * @property int $type;
 * @package App\Emulator\Npcs
 * @method static firstOrCreate(array $array, $toArray)
 */
class Npc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_npcs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'mapname',
        'job',
        'x',
        'y',
        'type'
    ];
}
