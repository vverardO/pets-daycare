<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_getting_first_15_users(): void
    {
        $userName = User::factory(15)
            ->create()
            ->pluck('name')
            ->toArray();

        $response = $this->get('/api/users');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertSee($userName);
    }
}
