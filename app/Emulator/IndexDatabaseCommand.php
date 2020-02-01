<?php

namespace App\Emulator;

use App\Emulator\Items\Item;
use App\Emulator\Items\ItemLookup;
use Illuminate\Console\Command;
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
        $crawler = new Crawler;

        /** @var ItemLookup $lookup */
        $lookup = ItemLookup::query()->take(5)->get();

        $progress = new ProgressBar($this->getOutput(), $lookup->count());

        foreach ($lookup as $item) {

            $itemPage = file_get_contents($crawler->getItem($item->id));
            $decoded   = json_decode($itemPage, true);
            $collection = collect($decoded);




            $progress->advance(1);
        }
    }
}
