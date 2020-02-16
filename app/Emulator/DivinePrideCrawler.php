<?php

namespace App\Emulator;

use App\Emulator\Items\ItemLookup;
use App\Emulator\Map\MapIndex;
use App\Emulator\Monsters\MonsterLookup;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class CollectItemDatabase
 *
 * @package App\Emulator
 */
class DivinePrideCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pride:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $items    = ItemLookup::query()->get();
        $monsters = MonsterLookup::query()->get();
        $maps     = collect(MapIndex::$maps);
        $progress = new ProgressBar($this->getOutput(), $items->count() + $monsters->count() + $maps->count());

        foreach ($maps as $map) {
            dispatch(new DivinePrideMapScraper($map, new DivinePrideRouter()));
            $progress->advance(1);
        }
//
    //     foreach ($items as $item) {
    //         dispatch(new DivinePrideItemScraper($item, new DivinePrideRouter));
    //         $progress->advance(1);
    //     }

    //    foreach ($monsters as $monster) {
    //        dispatch(new DivinePrideMonsterScraper($monster->toArray(), new DivinePrideRouter));
    //        $progress->advance(1);
    //    }
    }
}
