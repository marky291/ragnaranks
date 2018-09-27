<?php

namespace Tests\Unit;

use App\Exceptions\MonthlyReportAlreadyCreated;
use App\Jobs\MonthlyServerReport;
use App\Server;
use App\ServerReport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServerReportsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_report_should_flush_the_count_columns_on_servers_table()
    {
        $server = factory(Server::class)->create(['clicks_count' => 1, 'votes_count' => 1]);

        MonthlyServerReport::dispatchNow();

        $this->assertDatabaseHas('servers', ['id' => $server->id, 'votes_count' => 0, 'clicks_count' => 0]);
    }

    /**
     * @test
     */
    public function a_report_should_store_the_data_in_a_new_report_model()
    {
        $server = factory(Server::class)->create(['clicks_count' => 1, 'votes_count' => 1]);

        MonthlyServerReport::dispatchNow();

        $this->assertDatabaseHas('servers_reports', ['id' => $server->id, 'votes_count' => 1, 'clicks_count' => 1]);
    }

    /**
     * @test
     */
    public function a_report_can_not_be_run_on_the_same_month()
    {
        $server = factory(Server::class)->create(['clicks_count' => 1, 'votes_count' => 1]);

        MonthlyServerReport::dispatchNow();

        MonthlyServerReport::dispatchNow();

        $this->assertCount(1, $server->reports);
    }
}
