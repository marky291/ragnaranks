<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerModes.
 *
 * @property int $id
 * @property string $tag
 * @property string $name
 * @property string $description
 * @property Carbon $updated_at
 */
class Mode extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
