<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class AuthenticatorController extends Controller
{
    public function __construct(array $except = [])
    {
        $this->middleware('auth:api')
            ->except($except);
    }
}
