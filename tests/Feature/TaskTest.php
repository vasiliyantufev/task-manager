<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->task = factory(Task::class)->create();
        $this->actingAs($this->user);
    }


    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('tasks.show', $this->task->id));
        $response->assertStatus(200);
        $response->assertSee($this->task->name);
    }

    public function testUpdate()
    {
        $id = $this->task->id;
        $title = $this->task->title;
        $this->task->title = $title;
        $this->task->save();
        $taskRandomName = Str::random(32);
        $this->task->title = $taskRandomName;
        $this->task->save();

        $response = $this->get(route('tasks.show', $id));
        $response->assertStatus(200);
        $response->assertDontSee($title);
        $response->assertSee($taskRandomName);
    }

    public function testDestroy()
    {
        $id = $this->task->id;
        $this->task->delete();
        $response = $this->get(route('tasks.show', $id));
        $response->assertStatus(404);
    }
}
