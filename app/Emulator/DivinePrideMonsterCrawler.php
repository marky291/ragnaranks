<?php

namespace App\Emulator;

use App\Emulator\Items\ItemLookup;
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
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

class DivinePrideMonsterCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pride:crawl:monsters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var ItemLookup $lookup */
        $route  = new DivinePrideRouter;
        $lookups = MonsterLookup::query()->get();
        $crawled  = Monster::query()->get();
        $requiresCrawling = $lookups->diff($crawled);
        $progress = new ProgressBar($this->getOutput(), $requiresCrawling->count());

        foreach ($requiresCrawling as $element) {
            $link = $route->getMonster($element->ID);

            try {
                $content = file_get_contents($link, true);
                $decode = json_decode($content, true);

                $monster = Monster::firstOrCreate(['id' => $decode['id']], $decode);
                $this->extractMonsterDrops($decode, $monster);
                $this->extractMonsterSpawnSets($decode, $monster);
                $this->extractMonsterSlaves($decode, $monster);
                $this->extractMonsterMetamorphosis($decode, $monster);
                $this->extractMonsterSounds($decode, $monster);
                $this->extractMonsterQuestsObjectives($decode, $monster);
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

                $this->extractMonsterImages($monster, $route);

            }
            catch (Exception $exception) {
                $this->error($link . " " . $exception->getMessage());
            }

            $progress->advance(1);
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterDrops($decode, $monster): void
    {
        foreach ($decode['drops'] as $drop) {
            MonsterDrops::firstOrCreate(['monster_id' => $monster->id, 'item_id' => $drop['itemId'], 'serverTypeName' => $drop['serverTypeName']], array_merge($drop, ['item_id' => $drop['itemId']]));
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterSpawnSets($decode, $monster): void
    {
        foreach ($decode['spawnSet'] as $spawnset) {
            MonsterSpawnSet::firstOrCreate(['monster_id' => $monster->id], $spawnset);
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterSlaves($decode, $monster): void
    {
        foreach ($decode['slaves'] as $slave) {
            MonsterSlaves::firstOrCreate(array_merge($slave, ['monster_id' => $monster->id]));
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterMetamorphosis($decode, $monster): void
    {
        foreach ($decode['metamorphosis'] as $metamorphosis) {
            MonsterMetamorphosis::firstOrCreate(array_merge($metamorphosis, ['monster_id' => $monster->id]));
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterSounds($decode, $monster): void
    {
        foreach ($decode['sounds'] as $sound) {
            MonsterSounds::firstOrCreate(['monster_id' => $monster->id, 'filename' => $sound]);
        }
    }

    /**
     * @param $decode
     * @param $monster
     */
    private function extractMonsterQuestsObjectives($decode, $monster): void
    {
        foreach ($decode['questObjective'] as $quest) {
            MonsterQuestObjective::firstOrCreate(['monster_id' => $monster->id, 'quest_id' => $quest]);
        }
    }

    /**
     * @param $monster
     * @param DivinePrideRouter $route
     */
    private function extractMonsterImages($monster, DivinePrideRouter $route): void
    {
        $filename = "{$monster->id}.png";
        $imagePath = "/collection/monster/{$filename}";
        $spritesheetPath = "/collection/monster/spritesheet/{$filename}";
        if (Storage::disk('spaces')->exists($imagePath) == false) {
            Storage::disk('spaces')->put($imagePath, file_get_contents($route->getMonsterImage($monster->id)));
        }
        if (Storage::disk('spaces')->exists($spritesheetPath) == false) {
            Storage::disk('spaces')->put($spritesheetPath, file_get_contents($route->getMonsterSpritesheet($monster->id)));
        }
    }
}
