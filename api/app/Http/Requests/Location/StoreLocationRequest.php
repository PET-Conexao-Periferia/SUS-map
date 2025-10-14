<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'photo' => ['nullable', 'image'],

            //description validation:
            'description' => ['nullable', 'array'],
            'description.name' => ['required.description', 'string'],
            'description.contact' => ['required.description', 'string'],

            //services validation:
            'services' => ['nullable', 'array'],
            'services.*.name' => ['required.services', 'string'],
            // 'services.*' => '[required.services,id', 'integer]'
        ];
    }
}
