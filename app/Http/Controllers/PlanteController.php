<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Plante;
use App\Http\Requests\StorePlanteRequest;
use App\Http\Requests\UpdatePlanteRequest;
use App\RepositorieInterface\PhotoRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class PlanteController extends Controller
{
    protected $planteRepository;
    protected $photoRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository,
                                PhotoRepositoryInterface $photoRepository
                                )
    {
        $this->planteRepository = $planteRepository;
        $this->photoRepository = $photoRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->only('search') ?? null;
        if (!$search) {
            $result = $this->planteRepository->getAllPlantes();
        } else {
            $result = $this->planteRepository->searchPlantes($search);
        }

        if ($result) {
            if (empty($result->items)) {
                $message = "Il n'existe actuellement aucun plante associé à notre site.";
                $status = 404;
                $data = $result;
            } else {
                $message = 'Plantes trouvés avec succès.';
                $status = 200;
                $data = [];
            }
        } else {
            $message = 'Certaines erreurs sont survenues lors du returne des Plantes.';
            $status = 500;
            $data = null;            
        }
        
        return response()->json([
            'message' => $message,
            'plantes' => $data,
        ], $status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanteRequest $request)
    {
        $data = $request->only('name', 'description', 'prix', 'categorie_id');
        $photo['image'] = $request->file('image')->store('photos', 'public');

        $result = $this->planteRepository->createPlante($data);
        
        if ($result) {
            $photo['plante_id'] = $result->id;
            
            $insertImage = $this->photoRepository->insertImage($photo);

            if ($insertImage) {
                $message = 'La plante et la photo ont été créées avec succès.';
                $statusCode = 201;
            } else {
                $message = 'La plante a été créée, mais la photo n\'a pas pu être téléchargée.';
                $statusCode = 500;
            }
            
        } else {
            $message = 'Une erreur est survenue lors de la création de la plante.';
            $statusCode = 500;
        }

        return response()->json([
            'message' => $message,
            'plante' => $result,
            'planteImages' => $result->images,
        ], $statusCode);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Plante $plante)
    {

        if (!$plante) {
            $message = 'Plante non trouvée.';
            $status = 404;
        } else {
            $message = 'Plante trouvée avec succès !';
            $status = 200;
        }
        return response()->json([
            'message' => $message,
            'plante' => $plante,
        ], $status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanteRequest $request, Plante $plante)
    {
        $data = $request->only('name', 'description', 'prix', 'categorie_id');
        $result = $this->planteRepository->updatePlante($data, $plante);

        if ($result) {
            $message = 'Le categorie a été modifiée avec succès.';
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
    public function destroy(Plante $plante)
    {
        $result = $this->planteRepository->deletePlante($plante);

        if ($result) {
            $message = 'La plante ' . $plante->name .' a été supprimée avec succès.';
            $statusCode = 200;
        } else {
            $message = 'Erreur lors de la suppression du plante.';
            $statusCode = 500;
        }
        
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
