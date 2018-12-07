<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 06/12/2018
 * Time: 14:31
 */

namespace App\Server;

use App\Server;
use App\ServerConfig;

class CardinalServerRepository extends Server
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function HighestVoteTrend()
    {
        return self::query()->orderByDesc('votes_trend')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function HighestClicksTrend()
    {
        return self::query()->orderByDesc('clicks_trend')->first();
    }

    /**
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function LatestServerReviews($limit = 3)
    {
        return self::query()->get();
    }
}