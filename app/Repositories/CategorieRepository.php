<?php 

namespace App\Repositories;

use App\Models\Categorie;
use App\RepositorieInterface\CategorieRepositoryInterface;

class CategorieRepository implements CategorieRepositoryInterface
{
    public function getAllCategories()
    {
        return Categorie::all();
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