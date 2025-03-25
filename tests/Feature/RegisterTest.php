<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $userData = [
            'first_name' => 'Mohammed',
            'last_name' => 'Mohammed',
            'email' => 'mohammedmohamed@gmail.com',
            'password' => 'mohammedmohammed',
            'password_confirmation' => 'mohammedmohammed',
            'role_id' => '3',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'user']);
        $response->assertJsonStructure(['message' => 'Vous vous êtes inscrit avec succès.']);
    }
}
