<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function signUp(RegistrationRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $token = $user->createToken('myapp-token')->plainTextToken;

        $user->forceFill([
            'remember_token' => $token,
        ])->save();

        return response()->json(['success' => true, 'code' => 201, 'message' => 'Success', 'token' => $token], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::getByEmailAndPassword($request->get('email'), $request->get('password'));
        if ($user) {
            $token = $user->createToken('myapp-token')->plainTextToken;

            $user->forceFill(['remember_token' => $token])->save();

            return response()->json(['success' => true, 'code' => 200, 'message' => 'Success', 'token' => $token], 200);
        }

        return response()->json(['success' => false, 'code' => 404, 'message' => 'user not found'], 404);
    }

    public function logout(Request $request): ?JsonResponse
    {
        $request->user()->tokens()->delete();

        $request->user()->forceFill([
            'remember_token' => '',
        ])->save();

        return null;
    }
}
