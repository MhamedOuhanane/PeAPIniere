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
            if ($result->count() != 0) {
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
        $data = $request->only('title', 'description');

        $result = $this->categorieRepository->createCategorie($data);

        if ($result) {
            $message = 'Le catégorie "' . $result->title . '" a été créée avec succès.';
            $statusCode = 201;
            $categorie = $result;  
        } else {
            $message = 'Erreur lors de la création de catégories.';
            $statusCode = 500;
            $categorie = null;
        }

        return response()->json([
            'message' => $message,
            'catégorie' => $categorie,
        ], $statusCode);
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
        $data = $request->only('title', 'description');
        $result = $this->categorieRepository->updateCategorie($data, $categorie);

        if ($result) {
            $message = 'Le categorie ' . $data['title'] .' a été modifiée avec succès.';
            $statusCode = 200;
        } else {
            $message = 'Erreur lors de la modification du categorie.';
            $statusCode = 500;
        }
        
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $result = $this->categorieRepository->deleteCategorie($categorie);

        if ($result) {
            $message = 'Le categorie "' . $categorie->title .'" a été supprimée avec succès.';
            $statusCode = 200;
        } else {
            $message = 'Erreur lors de la supprission du categorie.';
            $statusCode = 500;
        }
        
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
