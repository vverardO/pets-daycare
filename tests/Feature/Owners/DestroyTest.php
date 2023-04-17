<?php

namespace Tests\Feature\Owners;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_one_owner(): void
    {
        $owner = Owner::factory()->create();

        $response = $this->delete("/api/owners/{$owner->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertNoContent();
        $response->assertDontSee($owner->name);
    }
}
