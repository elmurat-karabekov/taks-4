<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return 'This is my login Method';
    }

    public function signup()
    {
        return response()->json('This is my registration method');
    }

    public function logout()
    {
        return response()->json('This is my logout method');
    }
}
