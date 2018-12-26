<?php

namespace App;

use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @property int $id
 * @property string $message
 * @property int $donation_score
 * @property int $update_score
 * @property int $class_score
 * @property int $item_score
 * @property int $support_score
 * @property int $hosting_score
 * @property int $content_score
 * @property int $event_score
 * @property Listing $listing
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App
 */
class Review extends Model
{
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
