<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_have_a_server()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Listing::class)->create(['user_id' => $user->id]);

        $this->assertCount(1, $user->listings);
    }

    /**
     * @test
     */
    public function it_can_have_multiple_servers()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Listing::class, 3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->listings);
    }
}
