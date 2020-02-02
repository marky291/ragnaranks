<?php

namespace App\Emulator;

use App\Emulator\Combos\Combo;
use App\Emulator\Items\Item;
use App\Emulator\Items\ItemCombo;
use App\Emulator\Items\ItemContains;
use App\Emulator\Items\ItemLookup;
use App\Emulator\Items\ItemMoveInfo;
use App\Emulator\Npcs\Npc;
use ErrorException;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class CollectItemDatabase
 *
 * @package App\Emulator
 */
class IndexDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:database';

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
        $crawler  = new DivinePrideCrawler;
        $lookup   = ItemLookup::query()->get();
        $progress = new ProgressBar($this->getOutput(), $lookup->count());

        // get the ids from lookup.
        // get the ids from item
        // collect numbers that dont exist for retrieval.

        foreach ($lookup as $element)
        {
            $link = $crawler->getItem($element->id);

            $this->extractItemImages($element, $crawler);

            try {
                $content = file_get_contents($link, true);
                $decode  = json_decode($content, true);

                /**
                 * Create the item if it does not exist.
                 */
                $item = Item::firstOrCreate(['id' => $element->id], $decode);
                /**
                 * Create an item move info if it does not exist.
                 */
                ItemMoveInfo::firstOrCreate(['item_id' => $item->id], $decode['itemMoveInfo']);
                /**
                 * Create the sellers, associate it with the item.
                 */
                $this->associateSellersWithItem($decode, $item);
                /**
                 * Create the contains, what do these items have
                 */
                $this->associateItemContainsItems($decode, $item);
                /**
                 * Create the item combos
                 */
                $this->extractSetCombos($decode);
                /**
                 * Let the user know it progressed an ID;
                 */
                $progress->advance(1);
            } catch (ErrorException $exception) {
                $this->error("Unable to retrieve ID {$element->id} at {$link}");
                DivinePrideItemCrawlError::firstOrCreate(['item_id' => $element->id], ['link' => $link, 'message' => $exception->getMessage()]);
            } catch (QueryException $exception) {
                $this->error($exception->getMessage() . ' ' . $link);
                DivinePrideItemCrawlError::firstOrCreate(['item_id' => $element->id], ['link' => $link, 'message' => $exception->getMessage()]);

            }
        }
    }

    /**
     * Create the sellers, get their id then sync up.
     *
     * @param $decode
     * @param $item
     */
    private function associateSellersWithItem($decode, $item): void
    {
        $associations = new Collection();

        foreach ($decode['soldBy'] as $soldBy) {
            $npc_id = $soldBy['npc']['id'];
            Npc::firstOrCreate(['id' => $npc_id], $soldBy['npc']);
            $associations->put($npc_id, ['price' => $soldBy['price']]);
        }

        $item->soldBy()->sync($associations->all());
    }

    /**
     * @param $decode
     * @param $item
     */
    private function associateItemContainsItems($decode, $item)
    {
        $associations = new Collection();

        foreach ($decode['itemSummonInfoContains'] as $contains) {
            ItemContains::firstOrCreate(['sourceId' => $contains['sourceId'], 'targetId' => $contains['targetId']], $contains);
        }
    }

    /**
     * @param $element
     * @param DivinePrideCrawler $crawler
     */
    private function extractItemImages($element, DivinePrideCrawler $crawler): void
    {
        $filename = "{$element->id}.png";
        $iconPath = "/items/icons/{$filename}";
        $collectionPath = "/items/{$filename}";

        if (Storage::exists($collectionPath) == false) {
            Storage::put($collectionPath, file_get_contents($crawler->getItemImage($element->id)));
        }
        if (Storage::exists($iconPath) == false) {
            Storage::put($iconPath, file_get_contents($crawler->getItemIcon($element->id)));
        }
    }

    /**
     * @param $decode
     * @return mixed
     */
    private function extractSetCombos($decode)
    {
        foreach ($decode['sets'] as $combo) {
            $set = Combo::firstOrCreate(['name' => $combo['name']], $combo);
            foreach ($combo['items'] as $item) {
                ItemCombo::firstOrCreate(['name' => $item['name'], 'item_id' => $item['itemId'], 'set_id' => $set->id]);
            }
        }
    }
}
