<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];

    /**
     * We dont use the updated_at column
     */
    const UPDATED_AT = null;

    /**
     * Get the owning commentable model.
     */
    public function viewable()
    {
        return $this->morphTo();
    }

    /**
     * Set the client IP to the current request.
     */
    public function byCurrentClientIP()
    {
        return $this->setAttribute('ip_address', request()->getClientIp());
    }
}
