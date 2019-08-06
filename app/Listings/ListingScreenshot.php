<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;

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
}
