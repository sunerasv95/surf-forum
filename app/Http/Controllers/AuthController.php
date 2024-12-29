<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SigninUser;
use App\Http\Requests\Auth\SignupUser;
use App\Services\Contracts\AuthServiceInterface;

class AuthController extends Controller
{
    private $authService;

    function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function signup(SignupUser $request)
    {
        $validatedData = $request->validated();
        return $this->authService->registerUser($validatedData);
    }

    function signin(SigninUser $request)
    {
        $validatedData = $request->validated();
        return $this->authService->authenticateUser($validatedData);
    }
}
