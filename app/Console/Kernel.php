<?php

namespace App\Console;

use App\Heartbeats\HeartbeatMonitor;
use App\Console\Commands\SitemapGenerator;
use App\Console\Commands\RankingRebuilder;
use App\Listings\ListingWebsiteStatusMonitor;
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
        SitemapGenerator::class,
        RankingRebuilder::class,
        HeartbeatMonitor::class,
        ListingWebsiteStatusMonitor::class,
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

        $schedule->command('heartbeat:monitor')->everyTenMinutes()
            ->pingOnSuccess('http://beats.envoyer.io/heartbeat/LUFTOvvId7ZAD1k');

        $schedule->command('website:monitor')->hourly()
            ->pingOnSuccess('http://beats.envoyer.io/heartbeat/LUFTOvvId7ZAD1k');
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
