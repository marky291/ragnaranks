<?php

namespace App\Listings\Reviews;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class ReviewCollection
 *
 * @package App\Reviews
 */
class ReviewCollection extends Collection
{

    public function countAverageScores()
    {
        $scores = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        $this->each(static function(Review $review) use (&$scores) {
            $scores[(int)ceil($review->average_score)]++;
        });

        return $scores;
    }

    public function countPercentScores()
    {
        $scores = $this->countAverageScores();

        $total = $this->count();

        foreach ($scores as $key => $score) {
            if ($score) {
                $scores[$key] = number_format((float)$score / $total * 100, 2, '.', '');
            }
        }

        return $scores;
    }
}
