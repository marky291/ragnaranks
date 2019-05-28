<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 21/12/2018
 * Time: 13:21.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Trait PeriodScope.
 *
 * @method static Collection onPeriod($date)
 * @method static Collection betweenPeriod($start, $end)
 */
trait Periods
{
    /**
     * @param Builder $query
     * @param Carbon $date
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeOnPeriod(Builder $query, Carbon $date)
    {
        return $query->whereDay('created_at', $date);
    }

    /**
     * @param Builder $query
     * @param Carbon $start
     * @param Carbon $end
     *
     * @return Builder
     */
    public function scopeBetweenPeriod(Builder $query, Carbon $start, Carbon $end)
    {
        return $query->whereBetween('created_at', [$end, $start]);
    }
}
