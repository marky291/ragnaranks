<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ListingConfiguration
 *
 * @package App
 */
class ListingConfiguration extends Model
{
    /**
     * We dont use a creation table only updated.
     *
     * @var string
     */
    public const CREATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'max_base_level','max_job_level','max_stats','max_aspd','base_exp_rate',
        'job_exp_rate','instant_cast_stat','drop_base_rate', 'drop_card_rate',
        'drop_base_mvp_rate','drop_card_mvp_rate', 'drop_base_special_rate',
        'drop_card_special_rate'
    ];
}
