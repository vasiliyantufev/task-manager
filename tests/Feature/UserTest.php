<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }


    public function testIndex()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('users.show', $this->user->id));
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    public function testUpdate()
    {
        $id = $this->user->id;
        $name = $this->user->name;
        $testName = 'TestNameCheck';

        $response = $this->get(route('users.show', $id));
        $response->assertStatus(200);

        $response->assertSee($name);
        $response->assertDontSee($testName);

        $this->user->name = $testName;
        $this->user->save();

        $response = $this->get(route('users.show', $id));
        $response->assertDontSee($name);
        $response->assertSee($testName);
    }

    public function testDestroy()
    {
        $id = $this->user->id;

        $user = User::find($id);
        $response = $this->get(route('users.show', $id));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);

        $user->delete();

        $response = $this->get(route('users.show', $id));
        $response->assertStatus(404);
    }

}
