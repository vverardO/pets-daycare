<?php

namespace Tests\Feature\Pets;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_storing_new_pet(): void
    {
        $owner = Owner::factory()->create();
        $stubPet = Pet::factory()->make();

        $response = $this->post('/api/pets/', [
            'name' => $stubPet->name,
            'description' => $stubPet->description,
            'pet_type_id' => $stubPet->pet_type_id,
            'owner_id' => $owner->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertSee($stubPet->name);
        $response->assertSee($stubPet->description);
        $response->assertSee($stubPet->pet_type_id);
    }

    public function test_name_and_pet_type_id_and_owner_id_are_required(): void
    {
        Owner::factory()->count(5)->create();

        $response = $this->post('/api/pets', []);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'name',
            'Informe o nome',
            'pet_type_id',
            'Informe um tipo de pet',
            'owner_id',
            'Informe um dono',
        ]);
    }

    public function test_name_is_max_size(): void
    {
        Owner::factory()->count(5)->create();

        $name = Str::random(65);

        $response = $this->post('/api/pets', [
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

        $response = $this->post('/api/pets', [
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
