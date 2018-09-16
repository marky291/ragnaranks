<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_have_a_server()
    {
        /** @var User $user */
        $user = factory('App\User')->create();

        factory('App\Server')->create(['user_id' => $user->id]);

        $this->assertCount(1, $user->servers);
    }

    /**
     * @test
     */
    public function a_user_can_have_multiple_servers()
    {
        /** @var User $user */
        $user = factory('App\User')->create();

        factory('App\Server', 3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->servers);
    }
}
