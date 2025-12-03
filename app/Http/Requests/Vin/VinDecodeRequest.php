<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinDecodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vin' => ['required', 'string', 'size:17', 'regex:/^[A-HJ-NPR-Z0-9]{17}$/i'],
        ];
    }

    public function messages(): array
    {
        return [
            'vin.required' => 'VIN is required.',
            'vin.string' => 'VIN must be a string.',
            'vin.size' => 'VIN must be exactly 17 characters long.',
            'vin.regex' => 'VIN contains invalid characters (I, O, Q not allowed).',
        ];
    }
}