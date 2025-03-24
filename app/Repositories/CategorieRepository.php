<?php 

namespace App\Repositories;

use App\Models\Categorie;
use App\RepositorieInterface\CategorieRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class CategorieRepository implements CategorieRepositoryInterface
{
    public function getAllCategories()
    {
        return DB::table('categories as cg')
                    ->leftJoin('plantes as pl', 'cg.id', '=', 'pl.categorie_id')
                    ->select('cg.*', DB::raw('COUNT(pl.*) as planteCounte'))
                    ->groupBy('cg.id')
                    ->get();
    }
    
    public function findCategorie($id)
    {
        return Categorie::find($id);
    }
    
    public function createCategorie($data)
    {
        return Categorie::create($data);
    }
    
    public function updateCategorie($data, $categorie)
    {
        return $categorie->update($data);
    }
    
    public function deleteCategorie($categorie)
    {
        return $categorie->delete();
    }
    
}