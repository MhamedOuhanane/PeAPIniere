<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Models\Plante;
use App\RepositorieInterface\PlanteRepositoryInterface;

class PlanteRepository implements PlanteRepositoryInterface
{
    public function getAllPlantes()
    {
        return Plante::with('images')->get();
    }

    public function searchPlantes($search)
    {
        return Plante::where('name', 'ILIKE', '%' . $search['search'] . '%')->get();
    }

    public function findPlante($slug)
    {
        return Plante::where('slug', $slug)->first();
    }

    public function createPlante($data)
    {
        return Plante::create($data);
    } 

    public function updatePlante($data, $plante)
    {
        return $plante->update($data);
    } 

    public function deletePlante($plante)
    {
        return $plante->delete();
    } 

}
