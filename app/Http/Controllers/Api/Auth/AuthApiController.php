<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais Inválidas!'
            ], 404);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token
        ], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }
}
