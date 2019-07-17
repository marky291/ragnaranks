<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 17/01/2019
 * Time: 21:10.
 */

namespace App\Interactions;

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Interaction.
 *
 * @method static Collection byClientIp($ip_address)
 * @method Collection latestByCurrentClientIp()
 * @method Collection hasInteractedDuring($hours)
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
     * @param Builder $query
     * @return Builder
     */
    public function scopeByCurrentIP(Builder $query) : Builder
    {
        return $query->byClientIp(request()->getClientIp())->latest();
    }

    /**
     * Return boolean of weather the current client IP has interacted.
     *
     * @param Builder $query
     * @param int $hours
     * @return bool
     */
    public function scopeHasInteractedDuring(Builder $query, int $hours): bool
    {
        return Carbon::now()->subHours($hours) <= $query->byCurrentIP()->pluck('created_at')->first();
    }
}
