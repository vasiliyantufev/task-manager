<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

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
        $response = $this->get(route('users.show', $this->user));
        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    public function testNotFound()
    {
        $response = $this->get(route('users.show', rand()));
        $response->assertStatus(404);
    }
}
