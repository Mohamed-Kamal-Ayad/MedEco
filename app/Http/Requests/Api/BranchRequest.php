<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'commercial_registration_number' => ['required', 'string', 'max:100', 'unique:pharmacy_branches'],
            'tax_number' => ['required', 'string', 'max:100'],
            'lat' => ['nullable', 'numeric'],
            'lng' => ['nullable', 'numeric'],
            'pharmacy_id' => ['required', 'exists:pharmacies,id'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'phone.required' => 'The phone number is required.',
            'address.required' => 'The address is required.',
            'commercial_registration_number.required' => 'The commercial registration number is required.',
            'tax_number.required' => 'The tax number is required.',
            'pharmacy_id.required' => 'A valid pharmacy is required.',
        ];
    }
}
