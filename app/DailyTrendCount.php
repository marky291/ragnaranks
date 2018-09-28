<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 28/09/2018
 * Time: 14:17
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait DailyTrendCount
 *
 * @package App
 */
trait DailyTrendCount
{
    /**
     * Get the trend count of the passed in server for the last two days.
     *
     * @param Server $server
     *
     * @return float
     */
    public static function getServerTrend(Server $server)
    {
        $yesterday = self::whereDate('created_at', '=', Carbon::now()->subDays(1))->where('server_id', $server->id)->count();
        $fortnight = self::whereDate('created_at', '=', Carbon::now()->subDays(2))->where('server_id', $server->id)->count();

        return round((($yesterday - $fortnight) / $fortnight) * 100, 2);
    }
}