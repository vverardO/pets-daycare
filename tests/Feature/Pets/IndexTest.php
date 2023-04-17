<?php

namespace Tests\Feature\Pets;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_getting_first_15_pets(): void
    {
        Owner::factory()->count(5)->create();
        $petsName = Pet::factory(15)
            ->create()
            ->pluck('name')
            ->toArray();

        $response = $this->get('/api/pets');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertSee($petsName);
    }
}
