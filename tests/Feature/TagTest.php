<?php

namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->tag = factory(Tag::class)->create();
        $this->actingAs($this->user);
    }


    public function testIndex()
    {
        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
        $response->assertSee($this->tag->name);
    }

    public function testUpdate()
    {
        $name = $this->tag->name;
        $this->tag->name = $name;
        $this->tag->save();
        $tagRandomName = Str::random(32);
        $this->tag->name = $tagRandomName;
        $this->tag->save();

        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
        $response->assertDontSee($name);
        $response->assertSee($tagRandomName);
    }

    public function testDestroy()
    {
        $name = $this->tag->name;
        $this->tag->delete();
        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
        $response->assertDontSee($name);
    }
}
