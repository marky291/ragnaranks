<?php

namespace App\Listings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ListingConfiguration.
 *
 * @property int max_base_level
 * @property int max_job_level
 * @property int max_stats
 * @property int max_aspd
 * @property int base_exp_rate
 * @property int job_exp_rate
 * @property int instant_cast_stat
 * @property int drop_base_rate
 * @property int drop_card_rate
 * @property int drop_base_mvp_rate
 * @property int drop_card_mvp_rate
 * @property int drop_base_special_rate
 * @property int drop_card_special_rate
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
        'max_base_level', 'max_job_level', 'max_stats', 'max_aspd', 'base_exp_rate',
        'job_exp_rate', 'instant_cast_stat', 'drop_base_rate', 'drop_card_rate',
        'drop_base_mvp_rate', 'drop_card_mvp_rate', 'drop_base_special_rate',
        'drop_card_special_rate', 'rate',
    ];

    /**
     * A configuration belongs to a single listing.
     *
     * @return BelongsTo|Listing
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
