<?php

namespace App\Console\Commands;

use App\Notifications\ServerHasGoneOfflineNotification;
use App\User;
use Exception;
use App\Listings\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Heartbeats\FluxControlPanelStatus;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\HeartbeatFailureNotification;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Logger\ConsoleLogger;

/**
 * Class CheckHeartbeats
 *
 * @property ConsoleLogger $console
 *
 * @package App\Console\Commands
 */
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
     * @return void
     */
    public function handle()
    {
        $task = &$this;
        $this->info('Heartbeat checkup being carried out');

        Listing::chunkById(100, static function (Collection $listings) use ($task) {
            foreach ($listings as $listing) {
                if ($listing->trashed() == false) {
                    $executionStartTime = microtime(true);
                    $task->checkListingHeartbeat($listing);
                    $executionEndTime = microtime(true);
                    $seconds = round($executionEndTime - $executionStartTime, 2);
                    $task->info("Completed {$listing->name} in {$seconds} seconds");
                }
            }
        });

        $this->info('Completed heartbeat checkup successfully');
    }

    /**
     * Asynchronously check the database heartbeat.
     *
     * @param Listing $listing
     */
    public function checkListingHeartbeat(Listing $listing): void
    {
        $response = new FluxControlPanelStatus($listing->website);

        try {
            // response worked, but we dont have anything to check.
            if ($response->exists()){
                $formattedData = json_decode($response->formattedData(), true);
                $listing->heartbeat()->update([
                    'recorder' => 'flux-cp',
                    'login' => $formattedData['login'] ? 'online' : 'offline',
                    'char' => $formattedData['char'] ? 'online' : 'offline',
                    'map' => $formattedData['map'] ? 'online' : 'offline',
                    'players' => $formattedData['players'],
                    'failure_count' => 0, // reset failure count if success.
                    'success_count' => DB::raw('success_count + 1'),
                ]);
            }
        } catch (Exception $e) {
            if ($listing->heartbeat->hasRecorder()) {
                $listing->heartbeat()->update([
                    'recorder' => 'flux-cp',
                    'login' =>'offline',
                    'char' => 'offline',
                    'map' => 'offline',
                    'players' => 0,
                    'failure_count' => DB::raw('failure_count + 1'),
                ]);

                if ($listing->heartbeat->failure_count == 0) {
                    Notification::send($listing->user, new ServerHasGoneOfflineNotification($listing));
                }

                // 36 = 1 per 10 minute, 6 per hour, notify after 6 hours
                if (($listing->heartbeat->failure_count + 1) % 144 == 0) {
                    Notification::send(
                        User::role('admin')->get(),
                        new HeartbeatFailureNotification($listing, $listing->heartbeat->failure_count + 1)
                    );
                }
            }
        }
    }
}
