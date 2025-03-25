<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthentificationTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        // $role = Role::factory()->create();
        $user = User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => 6,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message', 'user', 'token']);
        $response->assertJsonStructure([
            'message' => 'Connexion réussie.',
        ]);
    }
}
