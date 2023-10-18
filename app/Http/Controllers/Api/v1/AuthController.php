<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\Api\v1\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
    * @param AuthService $authService
    */
    public function __construct(private AuthService $authService) 
    {}

    public function login(LoginRequest $request)
    {
        $params = $request->validated();
        $response = $this->authService->login($params);
        return $response;
    }

    public function signup(SignupRequest $request) : JsonResponse
    {
        $request->validated($request->all());
        $result = $this->authService->signup($request);
        return $result;
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request);

        return $result;
    }
}
