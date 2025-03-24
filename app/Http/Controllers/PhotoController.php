<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\RepositorieInterface\PhotoRepositoryInterface;
use App\RepositorieInterface\PlanteRepositoryInterface;
use PhpParser\Node\Stmt\If_;

class PhotoController extends Controller
{
    protected $photoRepository;
    protected $planteRepository;

    public function __construct(PhotoRepositoryInterface $photoRepository,
                                PlanteRepositoryInterface $planteRepository
                                )
    {
        $this->photoRepository = $photoRepository;
        $this->planteRepository = $planteRepository;
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
    public function store(StorePhotoRequest $request)
    {
        $data = $request->only('image', 'plante_id');
        $plante = $this->planteRepository->findPlanteById($data['plante_id']);
        $imageCout = $plante->images->count();
        
        if ($imageCout <= 4) {
            $data['image'] = $request->file('image')->store('photos', 'public');
            $result = $this->photoRepository->insertImage($data);
            if ($result) {
                $message = 'L\'image a été téléchargée avec succès.';
                $statusCode = 200;
            } else {
                $message = 'Échec de l\'upload de l\'image.';
                $statusCode = 500;
            }
            
        } else {
            $message = 'Vous pouvez télécharger jusqu\'à 4 images uniquement.';
            $statusCode = 400;
        }

        return response()->json([
            'message' => $message,
        ], $statusCode);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
