<?php

namespace App\Http\Controllers;

use App\RepositorieInterface\CategorieRepositoryInterface;
use App\RepositorieInterface\CommandeRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    protected $userRepository;
    protected $categorieRepository;
    protected $planteRepository;
    protected $commandeRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                CategorieRepositoryInterface $categorieRepository,
                                PlanteRepositoryInterface $planteRepository,
                                CommandeRepositoryInterface $commandeRepository
                                )
    {
        $this->userRepository = $userRepository;
        $this->categorieRepository = $categorieRepository;
        $this->planteRepository = $planteRepository;
        $this->commandeRepository = $commandeRepository;
    
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->getAllUser();
        $categories = $this->categorieRepository->getAllCategories();
        $plantes = $this->planteRepository->getAllPlantes();
        $commandes = $this->commandeRepository->getAllCommndes();

        if (!$users) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des users.',
            ], 500);
        }
        if (!$categories) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des categories.',
            ], 500);
        }
        if (!$plantes) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des plantes.',
            ], 500);
        }
        if (!$commandes) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des commandes.',
            ], 500);
        }

        return response()->json([
            'message' => 'Données récupérées avec succès.',
            'users' => $users,
            'categories' => $categories,
            'plantes' => $plantes,
            'commandes' => $commandes,
        ], 200);
    }
}
