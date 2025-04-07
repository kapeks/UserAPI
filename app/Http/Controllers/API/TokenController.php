<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TokenService;

class TokenController extends Controller
{
    public function generate(TokenService $tokenService)
    {
        $token = $tokenService->generate();

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }
}
