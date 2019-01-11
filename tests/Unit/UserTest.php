<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_have_a_listing()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Listing::class)->create(['user_id' => $user->id]);

        $this->assertCount(1, $user->listings);
    }

    /**
     * @test
     */
    public function it_can_have_multiple_listings()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        factory(Listing::class, 3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->listings);
    }

    /**
     * @test
     */
    public function it_can_have_multiple_reviews()
    {
        $this->signIn();

        factory(Review::class)->create(['publisher_id' => auth()->user()->getAuthIdentifier()]);

        $this->assertCount(1, auth()->user()->reviews);
    }
}
