<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Plante;
use App\Http\Requests\StorePlanteRequest;
use App\Http\Requests\UpdatePlanteRequest;
use App\RepositorieInterface\PlanteRepositoryInterface;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class PlanteController extends Controller
{
    protected $planteRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository)
    {
        $this->planteRepository = $planteRepository;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plante $plante)
    {
        //
    }
}
