<?php

namespace App\Emulator\Monsters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Emulator\Monsters\Collections\MonsterDropCollection;

/**
 * Class MonsterDrops
 *
 * @property int $monster_id
 * @property int $item_id
 * @property int $chance
 * @property int $stealProtected
 * @property int $serverTypeName
 *
 * @method Builder whereServerType($type)
 *
 * @package App\Emulator\Monsters
 * @method static firstOrCreate(array $array)
 */
class MonsterDrops extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_monster_drops';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'monster_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monster_id',
        'item_id',
        'chance',
        'stealProtected',
        'serverTypeName',
    ];

    /**
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeWhereServerType(Builder $query, string $type): Builder
    {
        return $query->where('serverTypeName', $type);
    }

    /**
     * @return HasOne
     */
    public function monster(): HasOne
    {
        return $this->hasOne(Monster::class, 'id', 'monster_id');
    }

    public function getRateAttribute(): float
    {
        return $this->chance / 100;
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     * @return MonsterCollection
     */
    public function newCollection(array $models = [])
    {
        return new MonsterDropCollection($models);
    }
}
