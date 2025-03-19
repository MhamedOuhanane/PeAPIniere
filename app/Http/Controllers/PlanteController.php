<?php

namespace App\Http\Controllers;

use App\Models\Plante;
use App\Http\Requests\StorePlanteRequest;
use App\Http\Requests\UpdatePlanteRequest;

class PlanteController extends Controller
{
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
