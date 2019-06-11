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
 * @property string exp_title
 * @property Listing listing
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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The model's default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'max_base_level' => 0, 'max_job_level' => 0, 'max_stats' => 0, 'max_aspd' => 0, 'base_exp_rate' => 0,
        'job_exp_rate' => 0, 'instant_cast_stat' => 0, 'drop_base_rate' => 0, 'drop_card_rate' => 0,
        'drop_base_mvp_rate' => 0, 'drop_card_mvp_rate' => 0, 'drop_base_special_rate' => 0,
        'drop_card_special_rate' => 0,
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
