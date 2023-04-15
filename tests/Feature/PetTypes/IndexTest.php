<?php

namespace Tests\Feature\PetTypes;

use App\Models\PetType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_getting_all_pet_types(): void
    {
        $response = $this->get('/api/pet-types');

        $petTypesTitles = PetType::pluck('title')->toArray();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data']);
        $response->assertSeeInOrder($petTypesTitles);
    }
}
