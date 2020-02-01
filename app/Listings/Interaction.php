<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 17/01/2019
 * Time: 21:10.
 */

namespace App\Listings;

use App\Listings\Votes\Vote;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Interaction.
 *
 * @method Builder|Vote latestByCurrentClientIp()
 * @method Builder|Vote byCurrentIP()
 * @method Collection hasInteractedDuring($hours)
 * @method Builder|Vote days($days)
 * @method Builder|Vote selectDateTotals()
 * @method Builder|Vote whereRankable()
 * @method Builder|Vote byClientIp($ip_address)
 *
 * @property User $publisher
 */
abstract class Interaction extends Model
{
    /**
     * A review has a single publisher user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope votes to the current logged in IP Address.
     * @param Builder $query
     * @param string $ip_address
     * @return Builder
     */
    public function scopeByClientIp(Builder $query, string $ip_address): Builder
    {
        return $query->where('ip_address', $ip_address);
    }

    /**
     * @param Builder|Interaction $query
     * @return Builder
     */
    public function scopeByCurrentIP(Builder $query) : Builder
    {
        return $query->byClientIp(request()->getClientIp())->latest();
    }

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

    /**
     * Return boolean of weather the current client IP has interacted.
     *
     * @param Builder|Interaction $query
     * @param int $hours
     * @return bool
     */
    public function scopeHasInteractedDuring(Builder $query, int $hours): bool
    {
        return Carbon::now()->subHours($hours) <= $query->byCurrentIP()->pluck('created_at')->first();
    }

    /**
     * @param Builder $builder
     * @param int $days
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeDays(Builder $builder, int $days)
    {
        return $builder->whereRaw("created_at >= DATE_SUB(CURDATE(), INTERVAL {$days} DAY)");
    }

    /**
     * Scope the valid days it can be listed by.
     *
     * @param Builder $builder
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeWhereRankable(Builder $builder)
    {
        return $builder->whereDate('created_at', '>=', Carbon::today()->subDays(config('ranking.ignore_after_days')));
    }

    /**
     * @param Builder $builder
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeSelectDateTotals(Builder $builder)
    {
        return $builder->selectRaw("count(*) as total, DATE(created_at) as 'date'")->groupBy('date');
    }
}
