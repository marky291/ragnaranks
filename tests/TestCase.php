<?php

namespace Tests;

use App\Click;
use App\Listings\Listing;
use App\User;
use App\Interactions\Vote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\Response;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    /**
     * Set up a fake user with a listing.
     */
    public function signIn()
    {
        $user = factory(User::class)->create();

        $this->be($user);
    }

    public function createListing(array $attributes, int $votes_count, int $clicks_count)
    {
        $listing = factory(Listing::class)->create($attributes);

        $listing->votes()->saveMany(factory(Vote::class, $votes_count)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

        $listing->clicks()->saveMany(factory(Click::class, $clicks_count)->create(['created_at' => fake()->dateTimeBetween("-6 days", 'now')]));

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
