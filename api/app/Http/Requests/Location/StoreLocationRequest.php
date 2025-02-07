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
            'description.openingTimes' => ['nullable', 'array'],
            'description.openingTimes.day' => ['required.description.openingTimes', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'],
            'description.openingTimes.startTime' => ['required.description.openingTimes', 'date'],
            'description.openingTimes.endTime' => ['required.description.openingTimes', 'date'],
            
            //services validation:
            'services' => ['nullable', 'array'],
            'services.*.id' => ['nullable', 'exists:services,id'],
            'services.*.name' => ['required.services', 'string'],
            'services.*.openingTimes' => ['nullable', 'array'],
            'services.*.openingTimes.day' => ['required.services.openingTimes', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'],
            'services.*.openingTimes.startTime' => ['required.services.openingTimes', 'date'],
            'services.*.openingTimes.endTime' => ['required.services.openingTimes', 'date'],
        ];
    }
}
