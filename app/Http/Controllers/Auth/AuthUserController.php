<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUserRequest;
use App\Models\User;
use App\RepositorieInterface\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\ElasticaHandler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(AuthUserRequest $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $user = Auth::user();

            try {  
                $token = JWTAuth::fromUser($user);

                return response()->json([
                    'message' => 'Connexion réussie.',
                    'token' => $token,
                    'user' => $user,
                ], 200);

            } catch (JWTException $jwte) {
                return response()->json([
                    'message' => 'Une erreur est survenue lors de la création du token.Erreur:'.$jwte->getMessage()
                ], 500);
            }   
        } else {
            return response()->json([
                'message' => 'Email ou mot de passe est invalide.'
            ], 404);
        }
    }

    public function logout(User $user)
    {
        try {

            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Déconnexion réussie.']);
        } catch (JWTException $jwte) {
            return response()->json([
                'message' => "Une erreur est survenue lors de la déconnexion.Erreur: " . $jwte->getMessage() . " Veuillez réessayer plus tard."
            ], 500);
        }
    }
}
