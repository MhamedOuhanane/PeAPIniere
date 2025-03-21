<?php

namespace App\Repositories;

use App\Models\Plante;
use App\RepositorieInterface\planteRepositoryInterface;

class planteRepository implements planteRepositoryInterface
{
    public function getAllPlantes()
    {
        return Plante::all();
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
