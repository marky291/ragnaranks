<?php

namespace App\Emulator;

use App\Emulator\Items\Item;
use App\Emulator\Items\ItemLookup;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Exception;

/**
 * Class CollectItemDatabase
 *
 * @package App\Emulator
 */
class DivinePrideItemCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pride:crawl:items';

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
        /** @var ItemLookup $lookup */
        $lookups = ItemLookup::query()->take(50)->get();
        $crawled  = Item::query()->get();
        $requiresCrawling = $lookups->diff($crawled);
        $progress = new ProgressBar($this->getOutput(), $requiresCrawling->count());


        // get the ids from lookup.
        // get the ids from item
        // collect numbers that dont exist for retrieval.

        foreach ($requiresCrawling as $lookup)
        {
            try {
                dispatch(new DivinePrideItemScraper($lookup, new DivinePrideRouter));
            }
            catch (Exception $e)
            {
                $this->warn("Item: {$lookup->id} " . $e->getMessage());
            }

            $progress->advance(1);
        }
    }
}
