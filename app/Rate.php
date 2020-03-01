<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label', 'min', 'max'];

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
