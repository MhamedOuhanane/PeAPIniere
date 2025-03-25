<?php

namespace Tests\Feature;

use App\Models\Admine;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CatégorieTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_All(): void
    {
        $categories = Categorie::factory(20)->create();
        Role::factory()->create();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->getJson('/api/categorie');

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'catégories']);
        $response->assertJsonFragment([
            'message' => 'Les Catégories sont trouvées avec succès.',
            'catégories' => $categories
        ]);
    }

    public function test_find(): void
    {
        $categorie = Categorie::factory()->create();
        Role::factory()->create();
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->getJson('/api/categorie/'. $categorie->id);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'catégorie']);
        $response->assertJsonFragment([
            'message' => 'Le catégorie : ',
            'catégories' => $categorie
        ]);
    }

    public function test_create(): void
    {
        Role::factory()->create(['id' => 1, 'name' => 'admine', 'guard_name' => 'admine']);
        $user = Admine::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->postJson('/api/categorie', [
            'title' => 'Fleurs',
            'descripetion' => "Les fleurs sont un élément essentiel de l'écosystème, 
                                elles apportent beauté et couleur à nos vies. Elles 
                                jouent aussi un rôle crucial dans la pollinisation.",
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'catégorie']);
        $response->assertJsonFragment([
            'message' => 'Le catégorie "Flours" a été créée avec succès.',
        ]);
    }

    public function test_update(): void
    {
        $categorie = Categorie::factory()->create();
        Role::factory()->create(['id' => 1, 'name' => 'admine', 'guard_name' => 'admine']);
        $user = Admine::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->putJson('/api/categorie/'. $categorie->id, [
            'title' => 'Fleurs',
            'descripetion' => "Les fleurs sont un élément essentiel de l'écosystème, 
                                elles apportent beauté et couleur à nos vies. Elles 
                                jouent aussi un rôle crucial dans la pollinisation.",
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
    }

    public function test_delete(): void
    {
        $categorie = Categorie::factory()->create();
        Role::factory()->create(['id' => 1, 'name' => 'admine', 'guard_name' => 'admine']);
        $user = Admine::factory()->create();
        $token = JWTAuth::fromUser($user);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->putJson('/api/categorie/'. $categorie->id, [
            'title' => 'Fleurs',
            'descripetion' => "Les fleurs sont un élément essentiel de l'écosystème, 
                                elles apportent beauté et couleur à nos vies. Elles 
                                jouent aussi un rôle crucial dans la pollinisation.",
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
    }
}
