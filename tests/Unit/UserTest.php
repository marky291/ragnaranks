<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Support\Facades\Auth;
use App\Achievements\FounderAchievement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

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

        $listing = factory(Listing::class)->create();

        $listing->reviews()->save(factory(Review::class)->make(['user_id' => auth()->user()->getAuthIdentifier()]));

        $this->assertCount(1, auth()->user()->reviews);
    }

    public function test_it_defaults_to_member_role()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('member', $user->getRoleNames()->first());
    }

    public function test_it_can_unlock_founder_status()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $user->unlock(new FounderAchievement);

        $this->assertCount(1, $user->achievements);
    }

    public function test_it_has_important_email_preference()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_preference' => 'important']);

        $this->assertTrue($user->isSubscribedImportantEmails);
    }

    public function test_it_has_all_email_preference()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_preference' => 'all']);

        $this->assertTrue($user->isSubscribedAllEmails);
    }
}
