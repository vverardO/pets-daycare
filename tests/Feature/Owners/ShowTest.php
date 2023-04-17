<?php

namespace Tests\Feature\Owners;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_showing_one_owner(): void
    {
        $owner = Owner::factory()->create();

        $response = $this->get("/api/owners/{$owner->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data']);
        $response->assertSee($owner->name);
        $response->assertSee($owner->general_record);
        $response->assertSee($owner->registration_physical_person);
        $response->assertSee($owner->birth_date);
        $response->assertSee($owner->gender->value);
    }
}
