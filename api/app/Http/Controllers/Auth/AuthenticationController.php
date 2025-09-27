<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendVerificationCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAuthenticationRequest;
use App\Http\Requests\Auth\RegisterAuthenticationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(LoginAuthenticationRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken($user->email, [
            $user->is_admin ? 'user-admin' : 'user-common'
        ])->plainTextToken;

        return response([
            'token' => $token
        ], 200);
    }

    public function register(RegisterAuthenticationRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new SendVerificationCodeEvent($user->email));

        $token = $user->createToken($user->email, ['user-common'])->plainTextToken;

        return response([
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response([
            'message' => 'Logged out'
        ], 200);
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken($user->email, [
            $user->is_admin ? 'user-admin' : 'user-common'
        ])->plainTextToken;

        return response([
            'token' => $token
        ], 200);
    }
}
