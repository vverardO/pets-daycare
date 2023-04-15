<?php

namespace Tests\Feature\Pets;

use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_one_pet(): void
    {
        $pet = Pet::factory()->create();

        $stubPet = Pet::factory()->make();

        $response = $this->put("/api/pets/{$pet->id}", [
            'name' => $stubPet->name,
            'description' => $stubPet->description,
            'pet_type_id' => $stubPet->pet_type_id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($stubPet->name);
        $response->assertSee($stubPet->description);
    }
}
