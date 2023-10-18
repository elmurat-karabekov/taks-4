<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Cookie;

const SIX_MONTH_IN_MINUTES = 6 * 30 * 24 * 60;

trait HttpOnlyCookie {
    protected function responseWithCookie($user, $response) {
        $user->tokens()->delete();
        $token = $user->createToken('access-token')->plainTextToken;
        $cookie = Cookie::make('api', $token, SIX_MONTH_IN_MINUTES, null, null, true, true, false,
        'Strict' );
        return $response->cookie($cookie);
    }
}