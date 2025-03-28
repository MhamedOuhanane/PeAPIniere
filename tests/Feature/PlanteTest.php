<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\Plante;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PlanteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_find_slug(): void
    {
        $categorie = Categorie::factory()->create();
        $plante = Plante::factory()->create([
            'name' => 'Rose Flours',
            'description' => 'Les roses sont des plantes décoratives avec des pétales parfumés.',
            'prix' => '150.33',
            'categorie_id' => $categorie->id,
        ]);

        Role::factory()->create();
        $user = Client::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => "Bearer  $token",
            'Accept' => 'application/json',
        ])->get('/api/plante/rose-flours');
        

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'plante']);
        $response->assertJsonFragment([
            'message' => 'Plante trouvée avec succès !', 
            'plante' => $plante,
        ]);
    }
}
