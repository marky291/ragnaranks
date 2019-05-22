<?php

namespace App;

use App\Interactions\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    /**
     * Comment belongs to a review.
     */
    public function review()
    {
        $this->belongsTo(Review::class);
    }
}
