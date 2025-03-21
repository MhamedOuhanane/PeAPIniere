<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Client;
use App\Models\Plante;
use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    protected $planteRepository;
    protected $commandeRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository,
                                CommandeRepositoryInterface $commandeRepository
                                )
    {
        $this->planteRepository = $planteRepository;
        $this->commandeRepository = $commandeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->only('status');
        $client = Client::find(Auth::id());
        $commandes = [];

        if (!$status) {
            $message = 'Mes commandes: ';
            $commandes = $client->commandes;
            $statusMessage = 200;
        } else {
            $result = $this->commandeRepository->getClientCommandes($client, $status);
            if ($result) {
                $message = 'Les commandes qui '. $status['status'] . 'sont: ';
                $commandes = $result;
                $statusMessage = 200;
            } else {
                $message = 'Aucun tag trouvé avec le nom ' . $status['status'] . '.';
                $statusMessage = 404;
            }
            
        }

        return response()->json([
            'message' => $message,
            'commandes' => $commandes,
        ], $statusMessage);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request)
    {
        $client = Client::find(Auth::id());
        $data = $request->only('quantity', 'slug');
        $plante = $this->planteRepository->findPlante($data['slug']);
        if (!$plante) {
            $message = 'Plante n\'existe pas.';
            $status = 404;
        } else {
            $result = $this->commandeRepository->createCommande($data, $client, $plante);
            if ($result) {
                $message = 'La commande a été créée avec succès.';
                $status = 201;
            } else {
                $message = 'La création de la commande a échoué.';
                $status = 400;
            }
        }

        return response()->json([
            'message' => $message,
            'client' => $client,
            'plante' => $plante,
        ], $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        $result = $this->commandeRepository->deleteCommande($commande);
        if ($result) {
            $message = 'Le commande de #id='. $commande->id .'a étè supprimer avec succès';
            $status = 200; 
        } else {
            $message = 'Échec de la suppression de la commande #id='.$commande->id;
            $status = 500;
        }

        return response()->json([
            'message' => $message,
            'commande' => $commande,
        ], $status);
    }
}
