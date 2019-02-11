<?php

namespace App\Interactions;

use App\Listings\Listing;
use App\Periods;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Click
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App
 */
class Click extends Interaction
{

    /**
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
