<?php

namespace App\Http\Controllers\API\Partials;

use App\Emulator\Monsters\Monster;
use App\Http\Controllers\Controller;

class MonsterPartialsController extends Controller
{
    public function glance(string $monster_dbname)
    {
        $monster = Monster::where('dbname', '=', $monster_dbname)->first();

        dd($monster);
    }
}