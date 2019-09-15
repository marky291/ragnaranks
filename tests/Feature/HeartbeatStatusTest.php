<?php

namespace Tests\Feature;

use App\Heartbeats\Checkup;
use App\Heartbeats\FluxControlPanelStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HeartbeatStatusTest extends TestCase
{

    public function test_flux_control_xml_response()
    {
        $checkup = new FluxControlPanelStatus('https://xilero.net');

        $this->assertTrue($checkup->exists());
    }

    public function test_flux_control_data_response()
    {
        $checkup = new FluxControlPanelStatus('http://oracle-ro.com');

        $decoded = json_decode($checkup->formattedData(), true);

        $this->assertTrue($decoded['login']);
    }
}
