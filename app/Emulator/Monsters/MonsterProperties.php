<?php


namespace App\Emulator\Monsters;

use App\Emulator\Monsters\Collections\MonsterPropertiesCollection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MonsterProperties
 *
 * @property int $monster_id
 * @property int $neutral
 * @property int $water
 * @property int $earth
 * @property int $fire
 * @property int $wind
 * @property int $poison
 * @property int $holy
 * @property int $dark
 * @property int $ghost
 * @property int $undead
 *
 * @method static firstOrCreate(array $array_merge)
 *
 * @package App\Emulator\Monsters
 */
class MonsterProperties extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_properties';

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
        'neutral',
        'water',
        'earth',
        'fire',
        'wind',
        'poison',
        'holy',
        'dark',
        'ghost',
        'undead',
    ];

    public function elements()
    {
        return new MonsterPropertiesCollection([
            'neutral' => $this->neutral,
            'water' => $this->water,
            'earth' => $this->earth,
            'fire' => $this->fire,
            'wind' => $this->wind,
            'poison' => $this->poison,
            'holy' => $this->holy,
            'dark' => $this->dark,
            'ghost' => $this->ghost,
            'undead' => $this->undead,
        ]);
    }
}
