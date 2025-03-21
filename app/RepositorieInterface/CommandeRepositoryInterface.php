<?php

namespace App\RepositorieInterface;

interface CommandeRepositoryInterface 
{
    public function getAllCommndes();
    public function getClientCommandes($client, $status);
    public function findCommande($commande);
    public function createCommande($data, $client, $plante);
    public function updateCommande($data, $commande);
    public function deleteCommande($commande);
}