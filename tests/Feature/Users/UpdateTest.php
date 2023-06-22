<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_one_user(): void
    {
        $user = User::factory()->create();
        $stubUser = User::factory()->make();

        $response = $this->put("/api/users/{$user->id}", [
            'name' => $stubUser->name,
            'email' => $stubUser->email,
            'password' => $stubUser->password,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($stubUser->name);
        $response->assertSee($stubUser->description);
    }

    public function test_name_is_max_size(): void
    {
        $user = User::factory()->create();
        $stubUser = User::factory()->make();
        $name = Str::random(129);

        $response = $this->put("/api/users/{$user->id}", [
            'email' => $stubUser->email,
            'name' => $name,
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
        $invalidPassword = 'asd';

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
