<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $authService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
            ],
        ]);

        $this->authService = new AuthService();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     */
    public function login(LoginRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->validated())) {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        return $this->authService->createNewToken($token);
    }

    /**
     * Register a user.
     *
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->validated(),
            [
                'password' => bcrypt($request->password)
            ]
        ));

        return response()->json([
            'message' => 'User successfully registered.',
            'data' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return response()->json([
            'message' => 'User successfully signed out.'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->authService->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user());
    }
}
