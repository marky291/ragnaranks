<?php

namespace App\Console;

use App\Listing;
use App\Jobs\ReconstructRankingTable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Calculate a listing ranking for every sever every hour.
        $schedule->call(static function () {
            ReconstructRankingTable::dispatch();
        })->everyMinute()->thenPing('http://beats.envoyer.io/heartbeat/t6UbyPJHP264LPH');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
