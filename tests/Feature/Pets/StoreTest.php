<?php

namespace Tests\Feature\Pets;

use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_storing_new_pet(): void
    {
        $stubPet = Pet::factory()->make();

        $response = $this->post('/api/pets/', [
            'name' => $stubPet->name,
            'description' => $stubPet->description,
            'pet_type_id' => $stubPet->pet_type_id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertSee($stubPet->name);
        $response->assertSee($stubPet->description);
        $response->assertSee($stubPet->pet_type_id);
    }
}
