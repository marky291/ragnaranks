<?php

namespace App\Console;

use App\Console\Commands\GenerateSitemap;
use App\Console\Commands\RankingRebuilder;
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
        GenerateSitemap::class,
        RankingRebuilder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sitemap:generate')->daily()
            ->pingOnSuccess('http://beats.envoyer.io/heartbeat/dpsj5fOZpRGaDfX');

        $schedule->command('ranking:rebuilder')->daily()->storeOutput()
            ->pingOnSuccess('http://beats.envoyer.io/heartbeat/4Epr9gjSrl5Gzb1')->evenInMaintenanceMode();
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
