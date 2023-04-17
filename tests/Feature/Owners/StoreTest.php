<?php

namespace Tests\Feature\Owners;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_storing_new_owner(): void
    {
        $stubOwner = Owner::factory()->make();

        $response = $this->post('/api/owners', [
            'name' => $stubOwner->name,
            'general_record' => $stubOwner->general_record,
            'registration_physical_person' => $stubOwner->registration_physical_person,
            'birth_date' => $stubOwner->birth_date,
            'gender' => $stubOwner->gender->value,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertSee($stubOwner->name);
        $response->assertSee($stubOwner->general_record);
        $response->assertSee($stubOwner->registration_physical_person);
        $response->assertSee($stubOwner->birth_date);
        $response->assertSee($stubOwner->gender->value);
    }

    public function test_general_record_and_registration_physical_person_are_unique(): void
    {
        $owner = Owner::factory()->create();

        $response = $this->post('/api/owners', [
            'general_record' => $owner->general_record,
            'registration_physical_person' => $owner->registration_physical_person,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'general_record',
            'Registro j\u00e1 existe', // j\u00e1 = já
            'registration_physical_person',
            'Registro j\u00e1 existe', // j\u00e1 = já
        ]);
    }

    public function test_name_and_general_record_and_registration_physical_person_are_max_size(): void
    {
        $name = Str::random(129);
        $generalRecord = Str::random(11);
        $registrationPhysicalPerson = Str::random(12);

        $response = $this->post('/api/owners', [
            'name' => $name,
            'general_record' => $generalRecord,
            'registration_physical_person' => $registrationPhysicalPerson,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'name',
            'Tamanho excedido',
            'general_record',
            'Tamanho excedido',
            'registration_physical_person',
            'Tamanho excedido',
        ]);
    }

    public function test_birth_date_and_gender_are_invalid(): void
    {
        $response = $this->post('/api/owners', [
            'birth_date' => '24/12/1994',
            'gender' => 'Male',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'birth_date',
            'Formato inv\u00e1lido', // inv\u00e1lido = inválido
            'gender',
            'Op\u00e7\u00e3o inv\u00e1lida', // Op\u00e7\u00e3o inv\u00e1lida = Opção inválida
        ]);
    }
}
