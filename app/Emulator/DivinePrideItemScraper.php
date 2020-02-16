<?php

namespace App\Emulator;

use App\Emulator\DivinePrideEnumConverter;
use App\Emulator\Items\Enums\ItemTypes;
use App\Emulator\Items\ItemSupply;
use App\Emulator\Map\MapIndex;
use Exception;
use App\Emulator\Combos\Combo;
use App\Emulator\Items\Item;
use App\Emulator\Items\ItemCombo;
use App\Emulator\Items\ItemContains;
use App\Emulator\Items\ItemLookup;
use App\Emulator\Items\ItemMoveInfo;
use App\Emulator\Npcs\Npc;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Class DivinePrideStoreItem
 *
 * @package App\Jobs
 */
class DivinePrideItemScraper implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var DivinePrideRouter
     */
    private $router;
    /**
     * @var ItemLookup
     */
    private $lookup;

    /**
     * Create a new job instance.
     *
     * @param ItemLookup $lookup
     * @param DivinePrideRouter $router
     */
    public function __construct(ItemLookup $lookup, DivinePrideRouter $router)
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
        $link = $this->router->getItem($this->lookup->id);

        if (Storage::disk('spaces')->exists("collection/items/{$this->lookup->id}.png") == false) {
            Storage::disk('spaces')->put("collection/items/{$this->lookup->id}.png", file_get_contents($this->router->getItemImage($this->lookup->id)));
        }
        if (Storage::disk('spaces')->exists("collection/items/icons/{$this->lookup->id}.png") == false) {
            Storage::disk('spaces')->put("collection/items/icons/{$this->lookup->id}.png", file_get_contents($this->router->getItemIcon($this->lookup->id)));
        }

        $content = file_get_contents($link, true);
        $decode  = json_decode($content, true);

        /**
         * Create the item if it does not exist.
         */
        $item = Item::updateOrCreate(['id' => $this->lookup->id], array_merge($decode, [
            'script' => $this->lookup->script,
            'type' => DivinePrideEnumConverter::ItemTypeId($decode['itemTypeId']),
            'subType' => DivinePrideEnumConverter::ItemSubTypeId($decode['itemSubTypeId']),
            'position' => DivinePrideEnumConverter::LocationId($decode['location'], $decode['itemTypeId'] + $decode['itemSubTypeId']),
            'element' => DivinePrideEnumConverter::ElementFromProperty($decode['attribute']),
            'composition' => $decode['itemTypeId'] == 6 ? DivinePrideEnumConverter::CompositionId($decode['compositionPos']) : 'none',
            'description' => $decode['description'] ? $this->convertColorCodes($decode['description']) : $decode['description'],
        ]));

        /**
         * Create an item move info if it does not exist.
         */
        ItemMoveInfo::firstOrCreate(['item_id' => $this->lookup->id], $decode['itemMoveInfo']);

        /**
         * Create the sellers, associate it with the item.
         */
        foreach ($decode['soldBy'] as $soldBy) {
            ItemSupply::firstOrCreate(['item_id' => $this->lookup->id, 'npc_id' => $soldBy['npc']['id'], 'price' => $soldBy['price']]);
        }

        /**
         * Create the contains, what do these items have
         */
        foreach ($decode['itemSummonInfoContains'] as $contains) {
            ItemContains::firstOrCreate(['sourceId' => $contains['sourceId'], 'targetId' => $contains['targetId']], $contains);
        }
        /**
         * Create the item combos
         */
        foreach ($decode['sets'] as $combo) {
            $set = Combo::firstOrCreate(['name' => $combo['name']], $combo);
            foreach ($combo['items'] as $item) {
                ItemCombo::firstOrCreate(['name' => $item['name'], 'item_id' => $item['itemId'], 'set_id' => $set->id]);
            }
        }
    }

    private function convertColorCodes(string $description): string
    {
        $description = str_replace(array('^000000', '^'), array('</span>', '#'), $description);

        $description = preg_replace("(#[a-f\d]{6})", '<span style="color:$0">', $description);

        return nl2br($description);
    }
}
