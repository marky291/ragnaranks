<?php

namespace Tests\Unit;

use App\Heartbeats\FluxStatusInformer;
use PHPUnit\Framework\TestCase;

class FluxStatusInformerTest extends TestCase
{
    public function test_it_can_verify_it_is_online()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertEquals(200, $informer->isOnline());
    }

    public function test_it_can_get_a_login_online_status()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertTrue($informer->getLoginStatus());
    }

    public function test_it_can_get_a_char_online_status()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertTrue($informer->getCharStatus());
    }

    public function test_it_can_get_a_map_online_status()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertTrue($informer->getMapStatus());
    }

    public function test_it_can_get_a_player_count()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertGreaterThan(0, $informer->getPlayerCount());
    }

    public function test_is_can_retrive_the_recorder_name()
    {
        $informer = new FluxStatusInformer('http://reg.lupon-ro.net/');

        $this->assertEquals('FluxStatusInformer', $informer->recorderName());
    }
}
