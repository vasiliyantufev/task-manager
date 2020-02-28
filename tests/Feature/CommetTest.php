<?php

namespace Tests\Feature;

use App\Comment;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->task = factory(Task::class)->create();
        $this->comment = factory(Comment::class)->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);
    }

    public function testSeeComment()
    {
        $response = $this->get(route('comments.index'));
        $response->assertStatus(200);
        $response->assertSee($this->comment->name);
    }

    public function testDestroy()
    {
        $text = $this->comment->text;
        $this->comment->delete();
        $response = $this->get(route('comments.index'));
        $response->assertDontSee($text);
    }
}
