<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendVerificationCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\VerifyCodeVerificationMailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerificationMailController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $user = $request->user();

        event(new SendVerificationCodeEvent($user->email));

        return response(['message' => 'Código de verificação enviado'], 200);
    }

    public function verifyCode(VerifyCodeVerificationMailRequest $request)
    {
        $request->validated();

        $user = $request->user();
        $code = $request->code;

        $storedCode = Cache::get("verification_code_{$user->email}");

        if (!$storedCode || $storedCode !== $code) {
            return response(['error' => 'Código inválido ou expirado'],400);
        }

        Cache::forget("verification_code_{$user->email}");

        $user->email_verified_at = now();
        $user->save();

        return response(['message' => 'E-mail verificado com sucesso'],200);
    }
}
