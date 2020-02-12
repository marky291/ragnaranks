<?php

namespace App\Emulator\Map\Collections;

use Illuminate\Database\Eloquent\Collection;

class MapSpawnCollection extends Collection {

    public function sortByAmount()
    {
        return $this->sortByDesc(static function($spawn) {
            return $spawn->amount;
        });
    }
}