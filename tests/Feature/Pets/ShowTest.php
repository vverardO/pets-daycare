<?php

namespace Tests\Feature\Pets;

use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_showing_one_pet(): void
    {
        $pet = Pet::factory()->create();

        $response = $this->get("/api/pets/{$pet->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data']);
        $response->assertSee($pet->name);
        $response->assertSee($pet->description);
        $response->assertSee($pet->pet_type_id);
    }
}
