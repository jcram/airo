<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:api'], ['except' => ['login', 'register']]);
    }

    /**
     * Register new user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = bcrypt($request->password);
        $user = (new User($userData))->save();

        return Response::json(['user' => $user], 201);
    }

    /**
     * Get a JWT token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['message' => 'Unauthorized / Login Failed'], 401);
        }

        return Response::json(['token' => $token, 'type' => 'bearer']);
    }

    /**
     * Logout user
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return Response::json(['message' => 'Successfully logout']);
    }
}
