<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeVerificationMailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'digits:8']
        ];
    }
}
