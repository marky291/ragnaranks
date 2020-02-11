<?php


namespace App\Emulator\Monsters;


use Illuminate\Database\Eloquent\Collection;

class MonsterCollection extends Collection
{
    public function bestFarmingSpots()
    {
        $drops = $this->sortByDesc(static function($drop) {
            return ($drop->chance/100) * $drop->monster->spawns->max('amount');
        });

        return $drops;
    }
}
