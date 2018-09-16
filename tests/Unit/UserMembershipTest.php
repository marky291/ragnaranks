<?php

namespace Tests\Unit;

use App\Membership;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMembershipTest extends TestCase
{
    /**
     * @test
     */
    public function a_user_has_a_silver_membership()
    {
        /** @var User $user */
        $user = factory('App\User')->create();

        $this->assertTrue($user->isSilverMember());
    }

    /**
     * @test
     */
    public function a_user_can_become_a_gold_member()
    {
        /** @var User $user */
        $user = factory('App\User')->create();

        $user->subscribeGoldMembership();

        $this->assertTrue($user->isGoldMember());
    }

    /**
     * @test
     */
    public function a_user_can_become_a_silver_member()
    {
        /** @var User $user */
        $user = factory('App\User')->create();

        $user->subscribeGoldMembership();

        $user->subscribeSilverMembership();

        $this->assertTrue($user->isSilverMember());

        $this->isNull($user->membership_expiry);
    }
}
