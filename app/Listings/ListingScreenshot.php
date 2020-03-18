<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ListingScreenshot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link'
    ];

    public function getImageAttribute()
    {
        return Storage::disk('spaces')->url($this->link);
    }
}
