<?php


namespace Tests\Unit;


use App\Tag;
use Tests\TestCase;

class CardContainerTest extends TestCase
{
    public function test_it_can_create_an_container()
    {
        $listing = $this->createListing([], 3, 3);

        dd(app('cards'));
        $this->assertNotNull(app('cards'));
    }
}