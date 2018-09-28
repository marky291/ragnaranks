<?php

namespace App\Jobs;

use App\Server;
use App\ServerReport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class GenerateServerReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Server
     */
    private $server;

    /**
     * Create a new job instance.
     *
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->doesNotHaveMonthlyReport())
        {
            DB::transaction(function ()
            {
                $this->server->reports()->save(new ServerReport([
                    'votes_count' => $this->server->votes_count,
                    'clicks_count' => $this->server->clicks_count,
                ]));

                $this->server->resetCounters();

            }, 5);
        }
    }

    private function doesNotHaveMonthlyReport()
    {
        return ! $this->server->reports()->whereDate('created_at', '>', Carbon::now()->startOfMonth())->count();
    }
}
