<?php

namespace App\Repositories;

use App\Models\Commande;
use App\RepositorieInterface\CommandeRepositoryInterface;

class CommandeRepository implements CommandeRepositoryInterface
{
    public function getAllCommndes()
    {
        return Commande::all();
    }

    public function getClientCommandes($client)
    {
        
    }

    public function findCommande($commande)
    {
        
    }

    public function createCommande($data, $client, $plante)
    {
        try {
            $client->plantes()->attach($plante->id, [
                'quantity' => $data['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateCommande($data, $commande)
    {
        
    }

    public function deleteCommande($commande)
    {
        
    }

}