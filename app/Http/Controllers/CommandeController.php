<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Client;
use App\Models\Plante;
use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
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
    public function index()
    {
        //
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
        //
    }
}
