<?php


namespace App\Emulator\Map;


use Illuminate\Database\Eloquent\Model;
use App\Emulator\Map\Collections\MapSpawnCollection;
use App\Emulator\Monsters\Monster;

/**
 * Class MonsterSpawns
 *
 * @property int $monster_id
 * @property string $mapname
 * @property int $amount
 * @property int $respawnTime
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array_merge)
 */
class MapSpawn extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_map_spawns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'mapname',
        'amount',
        'respawnTime',
    ];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     * @return MapSpawnCollection
     */
    public function newCollection(array $models = [])
    {
        return new MapSpawnCollection($models);
    }

    public function monster()
    {
        return $this->hasOne(Monster::class, 'id', 'monster_id');
    }
}
