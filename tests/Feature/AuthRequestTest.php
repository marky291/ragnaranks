<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthRequestTest extends TestCase
{
    public function test_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
