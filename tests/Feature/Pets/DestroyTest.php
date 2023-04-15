<?php

namespace Tests\Feature\Pets;

use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_one_pet(): void
    {
        $pet = Pet::factory()->create();

        $response = $this->delete("/api/pets/{$pet->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertNoContent();
        $response->assertDontSee($pet->name);
    }
}
