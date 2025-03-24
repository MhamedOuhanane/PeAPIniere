<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Client;
use App\Models\Plante;
use App\Models\User;
use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    protected $planteRepository;
    protected $commandeRepository;
    protected $userRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository,
                                CommandeRepositoryInterface $commandeRepository,
                                UserRepositoryInterface $userRepository
                                )
    {
        $this->planteRepository = $planteRepository;
        $this->commandeRepository = $commandeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        dd($user);
        if ($user->role == 'client') {
            $status = $request->only('status');
            $commandes = [];

            if (!$status) {
                $client = $this->userRepository->findUserById(Client::class, $user->id);
                $message = 'Mes commandes: ';
                $commandes = $client->commandes;
                $statusMessage = 200;
            } else {
                $result = $this->commandeRepository->getClientCommandes($user, $status);
                if ($result) {
                    $message = 'Les commandes qui '. $status['status'] . 'sont: ';
                    $commandes = $result;
                    $statusMessage = 200;
                } else {
                    $message = 'Aucun commande trouvé avec le nom ' . $status['status'] . '.';
                    $statusMessage = 404;
                }
                
            }
        } else {
            $result = $this->commandeRepository->getAllCommndes();
            if ($result) {
                $message = 'Les commandes sont: ';
                $commandes = $result;
                $statusMessage = 200;
            } else {
                $message = 'Aucun commande trouvé .';
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
        $status = $request->only('status');
        if ($commande->status == $status['status']) {
            $message = 'La commande a déjà ce statut.';
            $statusCode = 400;
        } else {
            $result = $this->commandeRepository->updateCommande($status, $commande);

            if ($result) {
                $message = 'La commande a été modifiée avec succès. Nouveau statut : ' . $status['status'];
                $statusCode = 200;
            } else {
                $message = 'Erreur lors de la modification de la commande.';
                $statusCode = 500;
            }
        }
        
        return response()->json([
            'message' => $message,
            'commande' => $commande,
        ], $statusCode);
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
