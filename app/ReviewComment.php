<?php

namespace App;

use App\Interactions\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * Comment belongs to a review.
     */
    public function review()
    {
        $this->belongsTo(Review::class);
    }
}
