<?php

namespace Tests;

use App\Listing;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    /**
     * Set up a fake user with a server.
     */
    public function signIn()
    {
        $user = factory(User::class)->create();

        $this->be($user);
    }

}
