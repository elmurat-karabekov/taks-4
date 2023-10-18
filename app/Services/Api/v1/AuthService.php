<?php

namespace App\Services\Api\v1;

use App\Models\User;
use App\Traits\HttpOnlyCookie;
use Illuminate\Support\Facades\Hash;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/**
 * Class AuthService.
 */
class AuthService
{
    use HttpResponses;
    use HttpOnlyCookie;

    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) {
            return $this->error('', 'Credential do not match any user', 401);
        }
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if(!$user->active) {
            return $this->error('', 'User is unauthorized', 401);
        }
        $user->update(['last_login' => now()]);
        $user->tokens()->delete();
        $response = $this->success([
            'user' => $user
        ]);
        $response = $this->responseWithCookie($user, $response);
        return $response;
    }

    public function signup($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $response = $this->success([
            'user' => $user
        ]);
        $response = $this->responseWithCookie($user,$response);
        return $response;
    }

    public function logout($request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $this->success('', 'User logged out successfuly', 201);
    }

}
