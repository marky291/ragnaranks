<?php

namespace App\Emulator\Combos;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sets
 *
 * @property integer $id
 * @property string $name
 *
 * @package App\Emulator\Sets
 */
class Combo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emulator_combos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

}
