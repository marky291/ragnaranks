<?php

namespace Tests\Unit;

use App\Heartbeats\FluxStatusInformer;
use PHPUnit\Framework\TestCase;

class FluxStatusInformerTest extends TestCase
{
    /**
     * @var FluxStatusInformer
     */
    private $informer;

    /**
     * Setup the tests for this class.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->informer = new FluxStatusInformer();
    }

    public function test_it_can_verify_it_is_online()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertEquals(200, $this->informer->isOnline());
    }

    public function test_it_can_get_a_login_online_status()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertTrue($this->informer->getLoginStatus());
    }

    public function test_it_can_get_a_char_online_status()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertTrue($this->informer->getCharStatus());
    }

    public function test_it_can_get_a_map_online_status()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertTrue($this->informer->getMapStatus());
    }

    public function test_it_can_get_a_player_count()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertGreaterThan(0, $this->informer->getPlayerCount());
    }

    public function test_is_can_retrive_the_recorder_name()
    {
        $this->informer->scrape('https://medieval-ro.com/');

        $this->assertEquals('FluxStatusInformer', $this->informer->recorderName());
    }

    public function test_it_does_not_examine_websites_with_404_error()
    {
        $this->informer->scrape('https://medieval-ro.com/feokfoe');

        $this->assertEquals(false, $this->informer->isOnline());
    }

//    public function test_it_does_not_examine_websites_that_timeout()
//    {
//        $this->markTestIncomplete(
//            'Requires a legit way to test a timeout consistently'
//        );
//
//        $this->informer->scrape('http://soul-ragnarok.com');
//
//        $this->assertEquals(false, $this->informer->isOnline());
//    }
}
