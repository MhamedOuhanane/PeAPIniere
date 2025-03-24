<?php

namespace App\Repositories;

use App\Models\Commande;
use App\RepositorieInterface\CommandeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CommandeRepository implements CommandeRepositoryInterface
{
    public function getAllCommndes()
    {
        return DB::table('commandes as cd')
                    ->leftJoin('clients as cl', 'cd.id', '=', 'cl.client_id')
                    ->select('cl.first_name', 'cl.last_name', 'cl.email', 'cd.*')
                    ->get();
    }

    public function getClientCommandes($client, $status)
    {
        return Commande::where($status)->where('client_id', $client->id);
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
        return $commande->update($data);
    }

    public function deleteCommande($commande)
    {
        return $commande->delete();
    }

}