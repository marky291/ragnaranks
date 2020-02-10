<?php

namespace App\Emulator\Map;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MapTypes
 *
 * @property int $id
 * @property string $mapname
 * @property int $amount
 * @property int $region
 *
 * @package App\Emulator\Map
 */
class MapType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_map_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'mapname',
        'amount',
        'region',
    ];
}
