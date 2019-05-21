<?php

namespace App\Console;

use App\Jobs\RankServerCollection;
use App\Jobs\UpdateServerTrendGrowth;
use App\Jobs\DispatchServerReports;
use App\Jobs\GenerateServerReport;
use App\Listing;
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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // Generate a monthly report for all servers.
        $schedule->call(function () {
            foreach (Listing::all() as $server) {
                GenerateServerReport::dispatch($server);
            }
        })->monthlyOn(1, '00:00');

        // Update the trend growth every day for all servers.
        $schedule->call(function() {
            foreach (Listing::all() as $server) {
                UpdateServerTrendGrowth::dispatch($server);
            }
        })->dailyAt('00:00');

        // Calculate a listing ranking for every sever every hour.
        $schedule->call(function() {
            RankServerCollection::dispatch(Listing::all());
        })->everyFiveMinutes();

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
