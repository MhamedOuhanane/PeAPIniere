<?php

namespace App\RepositorieInterface;

interface PlanteRepositoryInterface
{
    public function getAllPlantes();
    public function searchPlantes($search);
    public function findPlanteBySlug($slug);
    public function findPlanteById($id);
    public function createPlante($data);
    public function updatePlante($data, $plante);
    public function deletePlante($plante);
}