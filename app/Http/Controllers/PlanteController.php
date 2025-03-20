<?php

namespace App\Http\Controllers;

use App\Models\Plante;
use App\Http\Requests\StorePlanteRequest;
use App\Http\Requests\UpdatePlanteRequest;
use App\RepositorieInterface\planteRepositoryInterface;

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
    public function index()
    {
        $result = $this->planteRepository->getAllPlantes();

        if (empty($result)) {
            $message = 'Transactions trouvés avec succès.';
            $status = 200;
        } elseif ($result) {
            $message = "Il n'existe actuellement aucun plante associé à notre site.";
            $status = 404;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plante $plante)
    {
        //
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
