<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Models\Plante;
use App\Http\Requests\StorePlanteRequest;
use App\Http\Requests\UpdatePlanteRequest;
use App\RepositorieInterface\planteRepositoryInterface;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class PlanteController extends Controller
{
    protected $planteRepository;

    public function __construct(planteRepositoryInterface $planteRepository)
    {
        $this->planteRepository = $planteRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->only('search') ?? null;
        $result = [];
        if (!$search) {
            $result = $this->planteRepository->getAllPlantes();
        } else {
            $result = $this->planteRepository->searchPlantes($search);
        }

        if (empty($result)) {
            $message = "Il n'existe actuellement aucun plante associé à notre site.";
            $status = 404;
        } elseif ($result) {
            $message = 'Transactions trouvés avec succès.';
            $status = 200;
        } else {
            $message = 'Certaines erreurs sont survenues lors du returne des transactions.';
            $status = 500;
        }
        
        return response()->json([
            'message' => $message,
            'plantes' => $result,
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
    public function show($slug)
    {
        $result = [];
        if (!$slug) {
            $message = 'Slug manquant.';
            $status = 404;
        } else {
            $result = $this->planteRepository->findPlante($slug);
            if ($result) {
                $message = 'Plante trouvée avec succès !';
                $status = 200;
            }else {
                $message = 'Plante non trouvée.';
                $status = 404;
            }

        }
        return response()->json([
            'message' => $message,
            'plante' => $result,
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
