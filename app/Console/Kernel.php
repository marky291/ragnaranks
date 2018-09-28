<?php

namespace App\Console;

use App\Jobs\UpdateServerTrendGrowth;
use App\Jobs\DispatchServerReports;
use App\Jobs\GenerateServerReport;
use App\Server;
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
            foreach (Server::all() as $server)
            {
                GenerateServerReport::dispatch($server);
            }
        })->monthlyOn(1, '00:00');

        $schedule->call(function() {
            foreach (Server::all() as $server)
            {
                UpdateServerTrendGrowth::dispatch($server);
            }
        })->dailyAt('00:00');

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
