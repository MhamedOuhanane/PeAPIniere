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
                    ->orderBy('commandeCount', 'DESC')
                    ->limit('5')
                    ->get();

                    // // DB::table('plantes as pl')

                    // Sélectionne la table plantes avec l'alias pl pour travailler avec les plantes.
                    
                    // // ->leftJoin('photos as ph', 'pl.id', '=', 'ph.plante_id')
                    
                    // Fait une jointure avec la table photos, en associant chaque plante à ses photos, même si certaines plantes n'ont pas de photos.
                    
                    // // ->leftJoin('commandes as cd', 'pl.id', '=', 'cd.plante_id')
                    
                    // Fait une jointure avec la table commandes, associant chaque plante à ses commandes, même si certaines plantes n'ont pas de commandes.
                    
                    // // ->select('pl.*', 'ph.*', DB::raw('COUNT(cd.*) AS commandeCount'))
                    
                    // Sélectionne toutes les colonnes de plantes et photos, et calcule le nombre de commandes pour chaque plante.
                    
                    // // ->groupBy('pl.id', 'ph.id')
                    
                    // Regroupe les résultats par l'identifiant de la plante et de la photo, ce qui est nécessaire pour le calcul du nombre de commandes.
                    
                    // // ->orderBy('commandeCount', 'DESC')
                    
                    // Trie les résultats en fonction du nombre de commandes, de la plus élevée à la plus basse.
                    
                    // // ->limit('5')
                    
                    // Limite le nombre de résultats à 5, affichant ainsi seulement les 5 plantes les plus commandées.
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
