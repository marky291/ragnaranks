<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerModes
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App
 */
class ServerMode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers_modes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
