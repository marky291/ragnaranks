<?php

namespace App\Interactions;

use App\Periods;
use Carbon\Carbon;

/**
 * Class Vote.
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin Eloquent
 */
class Vote extends Interaction
{
    /*
     * Scope methods for certain days.
     */
    use Periods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
