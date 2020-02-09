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
        $monsters = MonsterLookup::query()->get();
        $crawled  = Monster::query()->get();
        $lookups = $monsters->diff($crawled);
        $progress = new ProgressBar($this->getOutput(), $lookups->count());

        foreach ($lookups as $monster) 
        {
            dispatch(new DivinePrideMonsterScraper($monster->toArray(), new DivinePrideRouter));

            $progress->advance(1);
        }
    }
}
