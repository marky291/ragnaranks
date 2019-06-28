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

/**
 * Class Interaction.
 *
 * @method static Collection byClientIp($ip_address)
 * @method Collection latestByCurrentClientIp()
 * @method Collection hasClientInteractedWith($hours)
 *
 * @property User $publisher
 */
abstract class Interaction extends Model
{
    /**
     * A review has a single publisher user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope votes to the current logged in IP Address.
     * @param Builder $query
     * @param string $ip_address
     */
    public function scopeByClientIp(Builder $query, string $ip_address)
    {
        $query->where('ip_address', $ip_address);
    }

    /**
     * @param Builder $query
     */
    public function scopeLatestByCurrentClientIp(Builder $query)
    {
        $query->byClientIp(request()->getClientIp())->latest()->limit(1);
    }

    /**
     * Return boolean of weather the current client IP has interacted.
     *
     * @param Builder $query
     * @param int $hours
     * @return bool
     */
    public function scopeHasClientInteractedWith(Builder $query, int $hours)
    {
        return Carbon::now()->subHours($hours) <= $query->latestByCurrentClientIp()->pluck('created_at')->first();
    }
}
