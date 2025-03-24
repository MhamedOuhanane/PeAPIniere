<?php 

namespace App\RepositorieInterface;

interface CategorieRepositoryInterface
{
    public function getAllCategories();
    public function findCategorie($id);
    public function createCategorie($data);
    public function updateCategorie($data, $categorie);
    public function deleteCategorie($categorie);
}