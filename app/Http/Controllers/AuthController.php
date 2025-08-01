<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Http\Requests\AuthRequest\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user=User::create($request->validated());
        return response()->json(['message'=>'Registered Successfully','User'=>$user]);
    }
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated()))
        {
            return response()->json(['message'=>'Invalid email or password']);
        }
        else
        {
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken('auth_Token')->plainTextToken;
            return response()->json([
                'message'=>'User Loged in successfully ! ',
                'Token' => $token 
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'User LogOut Successfully'
        ]);
    }
}
