<?php


namespace App\Emulator\Map;

use App\Emulator\Items\ItemSupply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
 * @method static firstOrCreate(array $array)
 */
class MapNpc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_map_npcs';

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

    public function getImageAttribute()
    {
        return Storage::disk('spaces')->url("collection/npc/{$this->job}.png");
    }

    public function inventory()
    {
        return $this->hasMany(ItemSupply::class, 'npc_id', 'id');
    }
}
