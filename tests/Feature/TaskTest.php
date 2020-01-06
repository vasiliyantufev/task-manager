<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{

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
        $testName = 'TestNameCheck';

        $response = $this->get(route('tasks.show', $id));
        $response->assertStatus(200);

        $response->assertSee($title);
        $response->assertDontSee($testName);

        $this->task->title = $testName;
        $this->task->save();

        $response = $this->get(route('tasks.show', $id));
        $response->assertDontSee($title);
        $response->assertSee($testName);
    }

    public function testDestroy()
    {
        $id = $this->task->id;

        $response = $this->get(route('tasks.show', $id));

        $response->assertStatus(200);
        $response->assertSee($this->task->title);

        $this->task->delete();

        $response = $this->get(route('tasks.show', $id));
        $response->assertStatus(404);
    }

}
