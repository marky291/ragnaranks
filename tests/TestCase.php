<?php

namespace Tests;

use App\Tag;
use App\User;
use App\Listings\Listing;
use App\Listings\Votes\Vote;
use App\Listings\Clicks\Click;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    /**
     * Set up a fake user with a listing.
     * @param string $withRole
     * @return mixed
     */
    public function signIn(string $withRole = 'admin')
    {
        $user = factory(User::class)->create();

        $user->assignRole($withRole);

        $this->be($user);

        return $user;
    }

    public function createListing(array $attributes, int $votes_count, int $clicks_count, int $tag_count = 0)
    {
        $listing = factory(Listing::class)->create($attributes);

        $listing->votes()->saveMany(factory(Vote::class, $votes_count)->make(['created_at' => fake()->dateTimeBetween('-6 days', 'now')]));

        $listing->clicks()->saveMany(factory(Click::class, $clicks_count)->make(['created_at' => fake()->dateTimeBetween('-6 days', 'now')]));

        $listing->tags()->saveMany(Tag::all()->random($tag_count)->unique('id'));

        return $listing;
    }

    /**
     * @param TestResponse $response
     *
     * @return Collection|Model
     */
    public function viewData(TestResponse $response)
    {
        return $response->getOriginalContent()->getData()['listings'];
    }
}
