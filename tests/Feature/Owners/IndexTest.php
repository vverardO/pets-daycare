<?php

namespace Tests\Feature\Owners;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_getting_first_15_owners(): void
    {
        $ownersFeneralRecord = Owner::factory(15)
            ->create()
            ->pluck('general_record')
            ->toArray();

        $response = $this->get('/api/owners');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertSee($ownersFeneralRecord);
    }
}
