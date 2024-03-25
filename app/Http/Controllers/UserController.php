<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        Log::info("Here2");
        return "hola";
    }

    public function create(Request $request)
    {
        $response = $this->userService->createUser($request);
        return $this->returnResponse($response);
    }

    public function login(Request $request)
    {
        $response = $this->userService->login($request);
        return $this->returnResponse($response);
    }
}
