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
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $role = Role::factory()->create();
        $user = User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => $role->id,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'user', 'token']);
        $response->assertJsonFragment([
            'message' => 'Connexion réussie.',
        ]);
    }

    public function test_existence()
    {
        $role = Role::factory()->create();
        $user = User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => $role->id,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammed',
        ]);

        $response->assertStatus(404);
        $response->assertJson(["message" => "Email ou mot de passe est invalide."]);
    }

    public function test_request_email()
    {
        $role = Role::factory()->create();
        $user = User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => $role->id,
        ]);
        
        $response = $this->postJson('/api/login', [
            'password' => 'passwordpassword',
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            "message" => "The email field is required.",
            "errors" => [
                "email" => [
                    "The email field is required."
                ]
            ]
        ]);
    }

    public function test_request_password()
    {
        $role = Role::factory()->create();
        $user = User::create([
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => $role->id,
        ]);
        
        $response = $this->postJson('/api/login', [
            'email' => 'mohammedmohamed@gmail.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            "message" => "The password field is required.",
            "errors" => [
                "password" => [
                    "The password field is required."
                ]
            ]
        ]);
    }
}
