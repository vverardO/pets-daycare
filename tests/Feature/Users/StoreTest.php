<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_storing_new_user(): void
    {
        $stubUser = User::factory()->make();

        $response = $this->post('/api/users/', [
            'name' => $stubUser->name,
            'email' => $stubUser->email,
            'password' => $stubUser->password,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertSee($stubUser->name);
        $response->assertSee($stubUser->email);
    }

    public function test_name_and_email_and_password_are_required(): void
    {
        $response = $this->post('/api/users', []);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'name',
            'Informe o nome',
            'email',
            'Informe o email',
            'password',
            'Informe a senha',
        ]);
    }

    public function test_name_is_max_size(): void
    {
        $stubUser = User::factory()->make();
        $name = Str::random(129);

        $response = $this->post('/api/users', [
            'email' => $stubUser->email,
            'name' => $name,
            'password' => $stubUser->password,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'name',
            'Tamanho excedido',
        ]);
    }

    public function test_password_validation(): void
    {
        $stubUser = User::factory()->make();
        $invalidPassword = Str::random(3);

        $response = $this->post('/api/users', [
            'name' => $stubUser->name,
            'password' => $invalidPassword,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'password',
            'Necess\u00e1rio no m\u00ednimo 6 d\u00edgitos',
        ]);
    }

    public function test_email_validation(): void
    {
        $stubUser = User::factory()->make();
        $invalidEmail = Str::random(5);

        $response = $this->post('/api/users', [
            'name' => $stubUser->name,
            'email' => $invalidEmail,
            'password' => $stubUser->name,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText('Revise os campos');
        $response->assertSeeTextInOrder([
            'email',
            'Email inv\u00e1lido',
        ]);
    }
}
