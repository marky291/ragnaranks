<?php

namespace App\Emulator;

use App\Emulator\Monsters\Monster;
use App\Emulator\Monsters\MonsterDrops;
use App\Emulator\Monsters\MonsterLookup;
use App\Emulator\Monsters\MonsterMetamorphosis;
use App\Emulator\Monsters\MonsterMvpDrops;
use App\Emulator\Monsters\MonsterPropertyTable;
use App\Emulator\Monsters\MonsterQuestObjective;
use App\Emulator\Monsters\MonsterSkills;
use App\Emulator\Monsters\MonsterSlaves;
use App\Emulator\Monsters\MonsterSounds;
use App\Emulator\Monsters\MonsterSpawns;
use App\Emulator\Monsters\MonsterSpawnSet;
use App\Emulator\Monsters\MonsterStats;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DivinePrideMonsterScraper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MonsterLookup
     */
    private $lookup;
    /**
     * @var DivinePrideRouter
     */
    private $router;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $lookup, DivinePrideRouter $router)
    {
        $this->lookup = $lookup;
        
        $this->router = $router;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $link = $this->router->getMonster($this->lookup['ID']);

        try {
            $content = file_get_contents($link, true);
            $decode = json_decode($content, true);

            $monster = Monster::firstOrCreate(['id' => $decode['id']], $decode);
            
            foreach ($decode['drops'] as $drop) {
                if ($drop['chance'] > 0) {
                    MonsterDrops::firstOrCreate(array_merge(['monster_id' => $monster->id, 'chance' => $drop['chance'], 'stealProtected' => $drop['stealProtected'], 'item_id' => $drop['itemId'], 'serverTypeName' => $drop['serverTypeName']]));
                }
            }

            foreach ($decode['spawnSet'] as $spawnset) {
                MonsterSpawnSet::firstOrCreate(['monster_id' => $monster->id], $spawnset);
            }

            foreach ($decode['slaves'] as $slave) {
                MonsterSlaves::firstOrCreate(array_merge($slave, ['monster_id' => $monster->id]));
            }

            foreach ($decode['metamorphosis'] as $metamorphosis) {
                MonsterMetamorphosis::firstOrCreate(array_merge($metamorphosis, ['monster_id' => $monster->id]));
            }

            foreach ($decode['sounds'] as $sound) {
                MonsterSounds::firstOrCreate(['monster_id' => $monster->id, 'filename' => $sound]);
            }

            foreach ($decode['questObjective'] as $quest) {
                MonsterQuestObjective::firstOrCreate(['monster_id' => $monster->id, 'quest_id' => $quest]);
            }

            MonsterStats::firstOrCreate(['monster_id' => $monster->id], $decode['stats']);

            foreach ($decode['mvpdrops'] as $drop) {
                MonsterMvpDrops::firstOrCreate(['monster_id' => $monster->id, 'item_id' => $drop['itemId'], 'chance' => $drop['chance'], 'serverTypeName' => $drop['serverTypeName']], $drop);
            }

            foreach ($decode['spawn'] as $spawn) {
                MonsterSpawns::firstOrCreate(array_merge(['monster_id' => $monster->id], $spawn));
            }

            foreach ($decode['skill'] as $skill) {
                MonsterSkills::firstOrCreate(array_merge(['monster_id' => $monster->id], $skill));
            }

            if ($decode['propertyTable']) {
                MonsterPropertyTable::firstOrCreate(array_merge(['monster_id' => $monster->id], $decode['propertyTable']));
            }

            if (Storage::disk('spaces')->exists("/collection/monster/{$monster->id}.png") == false) {
                Storage::disk('spaces')->put("/collection/monster/{$monster->id}.png", file_get_contents($this->router->getMonsterImage($monster->id)));
            }
            if (Storage::disk('spaces')->exists("/collection/monster/spritesheet/{$monster->id}.png") == false) {
                Storage::disk('spaces')->put("/collection/monster/spritesheet/{$monster->id}.png", file_get_contents($this->router->getMonsterSpritesheet($monster->id)));
            }
        }
        catch (Exception $exception) {
            Log::warning($exception->getMessage());
        }
    }
}
