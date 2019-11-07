<?php

namespace App\Services\Auth;

use Illumiante\Http\Request;
use App\User;

interface AuthenticationContract
{
    public function authenticate(Request $request): ?User;
}