<?php

namespace App\Heartbeats;

use App\Listings\Listing;
use App\Notifications\HeartbeatFailureNotification;
use App\Notifications\ServerHasGoneOfflineNotification;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Logger\ConsoleLogger;

/**
 * Class CheckHeartbeats
 *
 * @property ConsoleLogger $console
 *
 * @package App\Console\Commands
 */
class HeartbeatMonitorConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeat:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complete a checkup of all listings, and monitor retrieval data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $console = &$this;
        $this->warn('Attempting to look and check listing heartbeats');

        Listing::chunkById(100, static function (Collection $listings) use ($console) {
            foreach ($listings as $listing) {
                if ($listing->trashed() == false) {
                    $monitor = new HeartbeatCheckup($listing);
                    if ($monitor->hasInformer()) {
                        $monitor->recordResults();
                        $console->info("{$listing->name} checkup found {$monitor->getInformer()->getPlayerCount()} players online");
                    }
                }
            }
        });

//        if ($listing->heartbeat->failure_count == 0) {
//            Notification::send($listing->user, new ServerHasGoneOfflineNotification($listing));
//        }
//
//        // 36 = 1 per 10 minute, 6 per hour, notify after 6 hours
//        if (($listing->heartbeat->failure_count + 1) % 144 == 0) {
//            Notification::send(
//                User::role('admin')->get(),
//                new HeartbeatFailureNotification($listing, $listing->heartbeat->failure_count + 1)
//            );
//        }

        $this->warn('Completed heartbeat monitor successfully');
    }
}
