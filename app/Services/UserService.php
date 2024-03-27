<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request)
    {
        $user = $this->userRepository->getUserByEmail($request->email);
        if ($user) return response()->json(['error' => 'El usuario se encuentra registrado'], 400);
        return $this->userRepository->create($request);
    }

    public function login(Request $request)
    {
        $user = $this->userRepository->login($request);
        if (!$user) return response()->json(['error'=> 'Credenciales incorrectas'], 401);
        $user->makeHidden('hash');
        return $user;
    }
}
