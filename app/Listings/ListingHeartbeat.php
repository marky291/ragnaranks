<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;

class ListingHeartbeat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recorder', 'login', 'char', 'map', 'players',
    ];
}
