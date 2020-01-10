<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->comment = factory(Comment::class)->create();
        $this->actingAs($this->user);
    }


    public function testIndex()
    {
        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);
        $response->assertSee($this->comment->name);
    }

    public function testUpdate()
    {
        $text = $this->comment->text;
        $commentTestName = Str::random(64);

        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);

        $response->assertSee($text);
        $response->assertDontSee($commentTestName);

        $this->comment->text = $commentTestName;
        $this->comment->save();

        $response = $this->get(route('comments.index'));
        $response->assertDontSee($text);
        $response->assertSee($commentTestName);
    }

    public function testDestroy()
    {
        $name = $this->comment->text;
        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);
        $response->assertSee($this->comment->text);
        $this->comment->delete();
        $response = $this->get(route('comments.index'));
        $response->assertDontSee($name);
    }
}
