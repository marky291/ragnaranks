<?php

namespace App;

use App\Listing;
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
 * @property Listing $server
 *
 *
 * @package App
 */
class Click extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clicks';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
