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
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['votes' => 0, 'clicks' => 0, 'points' => 0];

    /**
     * We dont use a creation table only updated.
     *
     * @var string
     */
    public const CREATED_AT = null;
}
