<?php

namespace App\Emulator\Items;

use App\Emulator\DivinePrideEnumConverter;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Emulator\Monsters\MonsterDrops;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Item
 *
 * @property int $id
 * @property string $aegisName
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $slots
 * @property int $setname
 * @property int $itemTypeId
 * @property int $itemSubTypeId
 * @property int $attack
 * @property int $defence
 * @property int $weight
 * @property int $requiredLevel
 * @property int $limitLevel
 * @property int $weaponLevel
 * @property int $job
 * @property int $compositionPos
 * @property int $attribute
 * @property int $location
 * @property int $accessory
 * @property int $price
 * @property int $range
 * @property int $matk
 * @property int $gender
 * @property int $refinable
 * @property int $indestructible
 * @property int $cardPrefix
 * @property int $script
 *
 * @property string $image
 * @property string $type
 * @property string $subType
 * @property string $position
 * @property string $route
 *
 * @package App\Emulator\Items
 * @method static updateOrInsert(array $array)
 * @method static firstOrCreate(array $array, $decode)
 * @method static|Builder whereId($id)
 * @method static paginate(int $int)
 */
class Item extends Model
{

    use HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'aegisName',
        'name',
        'slug',
        'description',
        'slots',
        'setname',
        'itemTypeId',
        'itemSubTypeId',
        'attack',
        'defence',
        'weight',
        'requiredLevel',
        'limitLevel',
        'weaponLevel',
        'job',
        'compositionPos',
        'attribute',
        'location',
        'accessory',
        'price',
        'range',
        'matk',
        'gender',
        'refinable',
        'indestructible',
        'cardPrefix',
        'script'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the image of the item from digital ocean spaces.
     *
     * @return string
     */
    public function getImageAttribute(): string
    {
        return Storage::disk('spaces')->url("collection/items/{$this->id}.png");
    }

    /**
     * Get the route to the items page.
     */
    public function getRouteAttribute(): string
    {
        return url("/database/item/{$this->slug}");
    }
    /**
     * Get the image of the item from digital ocean spaces.
     *
     * @return string
     */
    public function getIconAttribute(): string
    {
        return Storage::disk('spaces')->url("collection/items/icons/{$this->id}.png");
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description'];
    }

    public function drops()
    {
        return $this->hasMany(MonsterDrops::class,'item_id','id')->where('chance', '!=', 0)->whereServerType('Renewal');
    }

    public function containers()
    {
        return $this->hasMany(ItemContains::class, 'targetId', 'id');
    }

    public function contains()
    {
        return $this->hasMany(ItemContains::class, 'sourceId', 'id');
    }

    public function supply()
    {
        return $this->hasMany(ItemSupply::class, 'item_id', 'id');
    }

    public function moveinfo()
    {
        return $this->hasOne(ItemMoveInfo::class,'item_id', 'id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getTypeAttribute()
    {
        return DivinePrideEnumConverter::ItemTypeId($this->itemTypeId);
    }
    public function getSubTypeAttribute()
    {
        return DivinePrideEnumConverter::ItemSubTypeId($this->itemSubTypeId);
    }
    public function getPositionAttribute()
    {
        return DivinePrideEnumConverter::LocationId($this->location, $this->itemTypeId + $this->itemSubTypeId);
    }
    public function getCompositionAttribute()
    {
        return DivinePrideEnumConverter::CompositionId($this->compositionPos);
    }
}
