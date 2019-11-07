<?php

namespace App\Services\Auth;

use Laravel\Lumen\Http\Request;
use App\User;

class DefaultLumenAuth implements AuthenticationContract {

    public function authenticate(Request $request): ?User
    {
        if ($request->input('api_token')) {
            return User::where('api_token', $request->input('api_token'))->first();
        }

        return null;
    }
}