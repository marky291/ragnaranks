<?php

namespace App\Console\Commands;

use App\Heartbeats\FluxControlPanelStatus;
use App\Listings\Listing;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CheckHeartbeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:heartbeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Heartbeats defines the retrieval of attributes from a source.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Checkup being carried out');

        Listing::chunkById(100, static function (Collection $listings) {
            /** @var Listing $listing */
            foreach ($listings as $listing) {
                $heartbeat = new FluxControlPanelStatus($listing->website);

                try {
                    if ($heartbeat->exists()) {
                        $status = json_decode($heartbeat->formattedData(), true);
                        $listing->heartbeat()->update([
                            'recorder' => 'flux-cp',
                            'login' => $status['login'] ? 'online' : 'offline',
                            'char' => $status['char'] ? 'online' : 'offline',
                            'map' => $status['map'] ? 'online' : 'offline',
                            'players' => $status['players'],
                        ]);
                    }
                } catch (RequestException $e) {
                    Log::warning("An error occurred checking heartbeat for {$listing->website}: {$e->getMessage()}");
                }
            }
        });

        return;
    }
}
