<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;

class ListingRanking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'rank', 'votes', 'points', 'clicks'];

    /**
     * We dont use a creation table only updated.
     *
     * @var string
     */
    public const CREATED_AT = null;
}
