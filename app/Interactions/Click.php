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
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
