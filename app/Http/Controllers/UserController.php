<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employe;
use App\Models\User;
use App\RepositorieInterface\RoleRepositoryInterface;
use App\RepositorieInterface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                RoleRepositoryInterface $roleRepository
                                )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $status = $request->only('status');
        $role = $this->roleRepository->FindRoleByName('employe'); 
        
        if (!$role) {
            $message = "Le rôle employé n'a pas été trouvé";
            $statusCode = 404; 

        } elseif ($status['status'] == 'Promotion' && $role) {
            $data = [
                'id' => 3,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'password' => $user->password,
                'role_id' => $role->id,
            ];
            dd($data);
            $delete = $this->userRepository->deleteUser($user);
            
            if ($delete) {
                $employe = new Employe();

                $result = $this->userRepository->register($data, $employe);
                if ($result) {
                    $message = "L'utilisateur " . $employe->getFullName() . " a été promu";
                    $statusCode = 200; 
                } else {
                    $message = "La mise à jour du rôle a échoué";
                    $statusCode = 500; 
                }
            } else {
                $message = "L'utilisateur n'a pas pu être supprimé";
                $statusCode = 500; 
            }
        } 

        return response()->json([
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
