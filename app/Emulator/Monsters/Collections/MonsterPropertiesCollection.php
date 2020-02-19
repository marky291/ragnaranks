<?php

namespace App\Emulator\Monsters\Collections;

use Illuminate\Support\Collection;

/**
 * This allows us to query the array, rather than the eloquent collection.
 */
class MonsterPropertiesCollection extends Collection
{
    public function strengths()
    {
        return $this->filter(function ($item) {
            return $item < 100;
        });
    }

    public function weaknesses()
    {
        return $this->filter(function ($item) {
            return $item > 100;
        });
    }
}