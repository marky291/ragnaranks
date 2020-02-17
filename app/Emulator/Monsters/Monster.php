<?php


namespace App\Emulator\Monsters;

use App\Emulator\Map\MapSpawn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Monster
 *
 * @property int $id
 * @property string $dbname
 * @property string $slug
 * @property string $name
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array, $decode)
 */
class Monster extends Model
{
    use HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monsters';

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
        'id',
        'dbname',
        'name',
        'slug',
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

    /**
     * Get the route to the items page.
     */
    public function getRouteAttribute(): string
    {
        return url("/database/monster/{$this->slug}");
    }

    public function spawns()
    {
        return $this->hasmany(MapSpawn::class, 'monster_id', 'id');
    }

    public function properties()
    {
        return $this->hasone(MonsterProperties::class, 'monster_id', 'id');
    }

    public function drops()
    {
        return $this->hasMany(MonsterDrops::class, 'monster_id', 'id');
    }

    public function stats()
    {
        return $this->hasone(MonsterStats::class, 'monster_id', 'id');
    }

    public function skills()
    {
        return $this->hasMany(MonsterSkills::class, 'monster_id', 'id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }
}
