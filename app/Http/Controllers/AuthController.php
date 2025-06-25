<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Debug user data
        \Log::info('Login attempt user data:', ['user' => $user]);

        if (!$user || !app('hash')->check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Debug employee_id
        \Log::info('User employee_id:', ['employee_id' => $user->employee_id]);

        $payload = [
            'iss' => env('APP_URL'),
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 3600 // 1 hour
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
            'employee_id' => $user->employee_id
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json($request->auth);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = null;
        $authHeader = $request->header('Authorization');
        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }
        if ($token) {
            // Blacklist the token until it would have expired
            $ttl = 3600; // 1 hour, match token expiry
            Cache::put('blacklisted_jwt_' . $token, true, $ttl);
        }
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        $user = $request->auth;
        $oldToken = null;
        $authHeader = $request->header('Authorization');
        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $oldToken = $matches[1];
        }
        if ($oldToken) {
            // Blacklist the old token
            $ttl = 3600; // 1 hour, match token expiry
            Cache::put('blacklisted_jwt_' . $oldToken, true, $ttl);
        }
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $payload = [
            'iss' => env('APP_URL'),
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 3600
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
        ]);
    }
}
