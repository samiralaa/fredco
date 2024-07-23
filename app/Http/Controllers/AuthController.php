<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    function totalUsers ()
    {
        $totalusers = DB::table('users')->count();
        return response()->json(['total'=>$totalusers]);
    }
    function login(LoginRequest $request)
    {

        $request->validate([
            'email' => 'required', 'exists:users,email', 'email',
            'password' => 'required', 'string', 'max:255',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'email Or password invalid'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'msg' => 'Login successfully!',
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => Auth::user()
        ], 200);
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logged out successfully!',
            'status_code' => 200
        ], 200);
    }
}
