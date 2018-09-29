<?php

namespace App\Jobs;

use App\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RankServerCollection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Collection
     */
    private $servers;

    /**
     * Create a new job instance.
     *
     * @param Collection $servers
     */
    public function __construct(Collection $servers)
    {
        $this->servers = $servers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->servers = $this->servers->sortByDesc(function(Server $server, int $key)  {
            return $server->votes_count + ($server->clicks_count / 2);
        });

        $this->servers = $this->servers->values()->each(function (Server $server, int $key) {
            return $server->update([
                'rank' => ($key + 1),
                'rank_growth' => ($key + 1) - $server->rank,
            ]);
        });
    }
}
