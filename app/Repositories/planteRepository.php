<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Models\Plante;
use App\RepositorieInterface\PlanteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PlanteRepository implements PlanteRepositoryInterface
{
    public function getAllPlantes()
    {
        return DB::table('plantes as pl')
                    ->leftJoin('photos as ph', 'pl.id', '=', 'ph.plante_id')
                    ->leftJoin('commandes as cd', 'pl.id', '=', 'cd.plante_id')
                    ->select('pl.*', 'ph.*', DB::raw('COUNT(cd.*) AS commandeCount'))
                    ->groupBy('pl.id', 'ph.id')
                    ->get();
    }

    public function searchPlantes($search)
    {
        return Plante::where('name', 'ILIKE', '%' . $search['search'] . '%')->get();
    }

    public function findPlanteBySlug($slug)
    {
        return Plante::where('slug', $slug)->first();
    }

    public function findPlanteById($id)
    {
        return Plante::find($id);
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
