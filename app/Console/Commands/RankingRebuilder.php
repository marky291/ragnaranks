<?php

namespace App\Console\Commands;

use App\Interactions\Click;
use App\Interactions\Vote;
use App\Listings\Listing;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class RankingRebuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranking:rebuilder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild/Build the ranking tables.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $counter = 0;

        $this->info('Ranking table will now be rebuilt!');

        $totalListings = Listing::count();

        $progress =  new ProgressBar($this->getOutput(), $totalListings);

        Listing::withCount(['clicks', 'votes'])->chunkById(100, static function (Collection $listings) use (&$counter, &$progress) {
            $listings = $listings->sortByDesc(static function (Listing $listing) {
                return $listing->points;
            });

            foreach ($listings as $listing) {
                $listing->ranking()->update(
                    ['rank' => ++$counter, 'points' => $listing->points, 'votes' => $listing->votes_count, 'clicks' => $listing->clicks_count]
                );
                $progress->advance(1);
            }
        });

        $this->info("\n\nRanking table rebuild completed!");
    }
}
