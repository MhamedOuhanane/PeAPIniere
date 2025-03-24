<?php

namespace App\Repositories;

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

}
