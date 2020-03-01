<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerModes.
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property Carbon $created_at
 */
class Mode extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];

    /**
     * @return string
     */
    public function getLabelAttribute()
    {
        if ($this->getOriginal('label')) {
            return ucwords($this->getOriginal('label'));
        }

        return ucwords(str_replace('-', ' ', $this->name));
    }
}
