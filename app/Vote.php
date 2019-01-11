<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Vote
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote betweenPeriod(\Carbon\Carbon $start, \Carbon\Carbon $end)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote onPeriod(\Carbon\Carbon $date)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vote whereIpAddress($value)
 * @mixin \Eloquent
 */

class Vote extends Model
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
