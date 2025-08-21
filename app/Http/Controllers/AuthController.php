<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Http\Requests\AuthRequest\LoginRequest;
use App\Enums\Roles;

class AuthController extends Controller
{
    /**
     * Register a new user and assign a role using Spatie.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        if ($request->has('role_name') && in_array($request->role_name, Roles::all())) {
            $user->assignRole($request->role_name);
        } else {
            $user->assignRole(Roles::FINAL_BENEFICIARY_HEAD_HOUSEHOLD);
        }
        return response()->json([
            'message' => 'Registered Successfully',
            'user' => $user->load('roles')
        ]);
    }

    /**
     * Log in a user and return an authentication token.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        } else {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_Token')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully!',
                'token' => $token,
                'user' => $user->load('roles')
            ]);
        }
    }

    /**
     * Log out the user (revoke the current access token).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }
}
