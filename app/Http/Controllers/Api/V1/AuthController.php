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
                    'token' =>$tokenResult,
                ]);
            }else {
                return response("Not Authorized",status: 403);
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

}
