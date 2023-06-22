<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_showing_one_user(): void
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data']);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }
}
