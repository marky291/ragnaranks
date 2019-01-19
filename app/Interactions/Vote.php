<?php

namespace App\Interactions;

use App\Listings\Listing;
use App\Periods;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Vote
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App
 * @mixin Eloquent
 */

class Vote extends Interaction
{
    /**
     * Scope methods for certain days.
     */
    use Periods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip_address'];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * A review belongs to a single listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
