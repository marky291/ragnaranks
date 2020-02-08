<?php


namespace App\Emulator\Monsters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Monster
 *
 * @property int $id
 * @property string $dbname
 * @property string $name
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array, $decode)
 */
class Monster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monsters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'dbname',
        'name',
    ];

    /**
     * Get the image of the item from digital ocean spaces.
     *
     * @return string
     */
    public function getImageAttribute(): string
    {
        return Storage::disk('spaces')->url("collection/monster/{$this->id}.png");
    }
}
