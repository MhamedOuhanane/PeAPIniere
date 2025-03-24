<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\Client;
use App\RepositorieInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function register(RegisterUserRequest $request)
    {

        $data = $request->only('first_name', 'last_name', 'email', 'password', 'role_id');
        $result = $this->userRepository->register($data, Client::class);

        if ($result) {
            $message = 'Vous vous êtes inscrit avec succès.';
            $status = 201;
        } else {
            $message = 'Certaines erreurs sont survenues lors de l\'incscription. Veuillez réessayer plus tard.';
            $status = 500;
        }       
        
        return response()->json([
            'message' => $message,
        ], $status);
    }
}
