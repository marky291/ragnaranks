<?php

namespace App\Emulator;

use App\Emulator\Map\Map;
use App\Emulator\Map\MapSpawn;
use App\Emulator\Map\MapNpc;
use App\Emulator\Map\MapType;
use App\Emulator\Map\MapTypes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

/**
 * Class DivinePrideMapScraper
 *
 * @package App\Emulator
 */
class DivinePrideMapScraper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var DivinePrideRouter
     */
    private $router;

    /**
     * @var string
     */
    private $mapname;

    /**
     * Create a new job instance.
     *
     * @param string $mapname
     * @param DivinePrideRouter $router
     */
    public function __construct(string $mapname, DivinePrideRouter $router)
    {
        $this->router = $router;

        $this->mapname = $mapname;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $route = $this->router->getMap($this->mapname);
        $content = file_get_contents($route, true);
        $decode  = json_decode($content, true);

        $map = Map::updateOrCreate([
            'mapname' => $decode['mapname'],
        ], $decode);

        foreach ($decode['spawn'] as $spawn)
        {
            $spawn = MapSpawn::updateOrCreate([
                'monster_id' => $spawn['monsterId'],
                'mapname'   => $map->mapname,
            ], $spawn);
        }

        foreach ($decode['npcs'] as $npc) {
            $npc = MapNpc::firstOrCreate($npc);
            if (Storage::disk('spaces')->exists("/collection/npc/{$npc->job}.png") == false) {
                Storage::disk('spaces')->put("/collection/npc/{$npc->job}.png", file_get_contents($this->router->getNpcImage($npc->job)));
            }
        }

        foreach ($decode['mapTypes'] as $type) {
            $type = MapType::firstOrCreate(['id' => $type['id'], 'mapname' => $map->mapname, 'region' => $type['region'], 'amount' => $type['amount']]);
        }
    }
}
