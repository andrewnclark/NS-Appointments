<?php

namespace App\Services\Auth;

use Laravel\Lumen\Http\Request;
use App\User;

interface AuthenticationContract
{
    public function authenticate(Request $request): ?User;
}