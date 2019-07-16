<?php

namespace Tests\Feature;

use App\Interactions\Click;
use App\Interactions\Vote;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_vote_stats()
    {
        $this->signIn();

        $response = $this->get('/api/voting/stats');

        $response->assertJson(array_merge(config('action.vote'),
            [
                'total' => 1,
                'spread' => 6,
                'value' => 7,
                'concluded' => 0
            ]
        ));
    }
}
