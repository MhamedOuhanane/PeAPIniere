<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\RepositorieInterface\CategorieRepositoryInterface;

class CategorieController extends Controller
{
    protected $categorieRepository;

    public function __construct(CategorieRepositoryInterface $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->categorieRepository->getAllCategories();

        if ($result) {
            if (empty($result)) {
                $message = 'Les Catégories sont trouvées avec succès.';
                $statusCode = 200;
                $data = $result;
            } else {
                $message = "Il n'existe actuellement aucun catégorie associé à notre site.";
                $statusCode = 404;
                $data = [];
            }
        } else {
            $message = 'Erreur lors de la récupération des catégories.';
            $statusCode = 500;
            $data = null;
        }

        return response()->json([
            'message' => $message,
            'catégories' => $data,
        ], $statusCode);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
