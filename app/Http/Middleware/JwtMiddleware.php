<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Illuminate\Support\Facades\Cache;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = null;
        $authHeader = $request->header('Authorization');
        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        // Check if token is blacklisted
        if (Cache::has('blacklisted_jwt_' . $token)) {
            return response()->json(['message' => 'Token is blacklisted'], 401);
        }

        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->auth = \App\Models\User::find($credentials->sub);
        } catch (Exception $e) {
            return response()->json(['message' => 'Token is invalid or expired'], 401);
        }

        return $next($request);
    }
}
