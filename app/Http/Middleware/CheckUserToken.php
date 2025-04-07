<?php

namespace App\Http\Middleware;

use App\Services\TokenService;
use Closure;

class CheckUserToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        $token = trim($token, '"');

        if (!$token || !TokenService::validate($token)) {
            return response()->json([
                'success' => false,
                'message' => 'The token expired.',
            ], 401);
        }

        return $next($request);
    }
}
