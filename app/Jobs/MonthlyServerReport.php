<?php

namespace App\Jobs;

use App\Exceptions\MonthlyReportAlreadyCreated;
use App\Server;
use App\ServerReport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class MonthlyServerReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws MonthlyReportAlreadyCreated
     */
    public function handle()
    {
        /** @var Server $server */
        foreach (Server::all() as $server)
        {
            if ($this->doesNotHaveMonthlyReport($server)) {
                DB::transaction(function () use ($server) {
                    $server->reports()->save(new ServerReport([
                        'votes_count' => $server->votes_count,
                        'clicks_count' => $server->clicks_count,
                    ]));

                    $server->resetCounters();
                }, 5);
            }
        }
    }

    private function doesNotHaveMonthlyReport(Server $server)
    {
        return ! $server->reports()->whereDate('created_at', '>', Carbon::now()->startOfMonth())->count();
    }

}
