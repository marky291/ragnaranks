<?php

namespace App\Interactions;

use App\Periods;
use Carbon\Carbon;

/**
 * Class Click.
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Click extends Interaction
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
    public const UPDATED_AT = null;
}
