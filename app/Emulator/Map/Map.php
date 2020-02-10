<?php

namespace App\Emulator\Map;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 *
 * @property string $mapname
 * @property string $name
 * @property string $mp3
 * @property string $mapType
 *
 * @package App\Emulator\Map
 */
class Map extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_maps';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'mapname';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mapname',
        'name',
        'mp3',
        'mapType',
    ];

}
