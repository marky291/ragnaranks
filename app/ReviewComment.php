<?php

namespace App;

use App\Reviews\Review;
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
