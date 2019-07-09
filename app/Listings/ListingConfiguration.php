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
 * @property string exp_title
 * @property Listing listing
 * @property bool pk_mode
 * @property int castrate_dex_scale
 * @property bool arrow_decrement
 * @property bool undead_detect_type
 * @property bool attribute_recover
 * @property int item_drop_common
 * @property int item_drop_equip
 * @property int item_drop_card
 * @property int item_drop_common_mvp
 * @property int item_drop_equip_mvp
 * @property int item_drop_card_mvp
 * @method static make(array $validated)
 */
class ListingConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'max_base_level', 'max_job_level', 'max_stats', 'max_aspd',
        'base_exp_rate', 'job_exp_rate', 'quest_exp_rate', 'instant_cast_stat',
        'pk_mode', 'castrate_dex_scale', 'arrow_decrement', 'undead_detect_type',
        'attribute_recover', 'item_drop_common', 'item_drop_equip', 'item_drop_card',
        'item_drop_common_mvp', 'item_drop_equip_mvp', 'item_drop_card_mvp',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'listing_id';

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
     * A configuration belongs to a single listing.
     *
     * @return BelongsTo|Listing
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
