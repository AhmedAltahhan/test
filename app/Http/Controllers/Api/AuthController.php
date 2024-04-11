<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete;
        return response()->json(['message' => "logged Out"],200);
    }

    public function login(LoginRequest $request)
    {

        $user = User::whereUsername($request->username)->first();
        if (Hash::check($request->password, $user->password)) {
            if($user->is_active == 0)
                return response()->json(['message' => "The user is not active"],200);
            else
            {
                $token = $user->createToken('Auth-Token')->plainTextToken;
                $user = AuthResource::make($user);
                return response()->json(['data' => $user,'message' => "Welcome ",'Token' => $token],200);
            }
        }
        return response()->json(['message' => "Username or password is incorrect"],200);
    }

    public function register(SignupRequest $request)
    {
        $user = $this->authService->user($request->validated());
        if ($request->hasFile('image'))
            $user->addMediaFromRequest('image')->toMediaCollection('avatar');
        return AuthResource::make($user);
    }
}
