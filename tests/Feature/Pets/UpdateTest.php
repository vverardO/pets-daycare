<?php

namespace Tests\Feature\Pets;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_one_pet(): void
    {
        Owner::factory()->count(5)->create();
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

    public function test_name_is_max_size(): void
    {
        Owner::factory()->count(5)->create();
        $pet = Pet::factory()->create();

        $name = Str::random(65);

        $response = $this->put("/api/pets/{$pet->id}", [
            'name' => $name,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'name',
            'Tamanho excedido',
        ]);
    }

    public function test_pet_type_id_and_owner_id_do_not_exists(): void
    {
        Owner::factory()->count(5)->create();
        $pet = Pet::factory()->create();

        $response = $this->put("/api/pets/{$pet->id}", [
            'pet_type_id' => 1000,
            'owner_id' => 1000,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'pet_type_id',
            'Tipo do pet inexistente',
            'owner_id',
            'Dono inexistente',
        ]);
    }
}
