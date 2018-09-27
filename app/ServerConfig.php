<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServerConfig
 *
 * @property int $max_base_level
 * @property int $max_job_level
 * @property int $max_stats
 * @property int $max_aspd
 *
 * @property int $base_exp_rate
 * @property int $job_exp_rate
 *
 * @property int $instant_cast_stat
 *
 * @property int $drop_base_rate
 * @property int $drop_card_rate
 * @property int $drop_base_mvp_rate
 * @property int $drop_card_mvp_rate
 * @property int $drop_base_special_rate
 * @property int $drop_card_special_rate
 * @package App
 */
class ServerConfig extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers_configs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class,'server_id', 'id');
    }

    /**
     * Scope the configs to specific exp groups.
     *
     * @param $query
     * @param string $group
     * @return mixed
     */
    public function scopeExpGroup(Builder $query, string $group)
    {
        return $query->whereBetween('base_exp_rate', [config('filter.exp.'.$group.'.min'), config('filter.exp.'.$group.'.max')]);
    }
}
