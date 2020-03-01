<?php

namespace Tests\Unit;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_generate_a_label_from_the_name_if_name_does_not_exist()
    {
        $tag = factory(Tag::class)->create(['name' => 'foo-bar']);

        $this->assertEquals('Foo Bar', $tag->label);
    }

    public function test_it_does_not_generate_a_lable_from_the_name_if_lable_exists()
    {
        $tag = factory(Tag::class)->create(['name' => 'foo', 'label' => 'bar']);

        $this->assertEquals('Bar', $tag->label);
    }
}
