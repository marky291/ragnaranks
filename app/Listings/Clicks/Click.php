<?php

namespace App\Listings\Clicks;

use Carbon\Carbon;
use App\Listings\Interaction;
use App\Listings\HasPerformingAction;

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
    use HasPerformingAction;

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    public const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];
}
