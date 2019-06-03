<?php

namespace Tests\Feature;

use App\Notifications\WelcomeNotification;
use App\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_register_a_user()
    {
        Notification::fake();

        $this->withoutExceptionHandling();

        $response = $this->post('/register', ['username' => 'unittester', 'email' => 'foo@bar.com', 'password' => 'password', 'password_confirmation' => 'password']);

        Notification::assertSentTo(User::where('username', 'unittester')->first(), WelcomeNotification::class);
    }
}
