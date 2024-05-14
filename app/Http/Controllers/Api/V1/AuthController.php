<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
     {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]);

            if(Auth::attempt($request->all())){
                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token', ['*'], now()->addDay());
                return response()->json([
                    'token' => $tokenResult,
                    'user' => $user
                ]);
            }else {
                return response()->json([
                    'message' => 'Not authorized.'
                ], 401);
            }
     }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user =  User::query()->create($request->all());
        return response()->json([$user], 201);
    }

    public function whoami(Request $request): JsonResponse
    {
        if(auth()->check()){
            $user = auth()->user();
            return response()->json([
                'user' => $user
            ]);
        }
        return response()->json([
                'message' => "Invalid token or user not found."
        ], 401);
    }

    public function verify(Request $request): JsonResponse
    {
        if(auth()->check()){
            return response()->json(null, 200);
        }
        return response()->json([
                'message' => "Invalid token or user not found."
        ], 401);
    }

}
