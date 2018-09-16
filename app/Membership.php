<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Memberships
 *
 * @property int $id
 * @property string $title
 *
 * @package App
 */
class Membership extends Model
{

    const TYPE_SILVER = 1;
    const TYPE_GOLD = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'memberships';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
