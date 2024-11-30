<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'],
            'type' => ['required', 'in:user,pharmacy'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'national_id' => ['required', 'string', 'max:14', 'unique:users,national_id'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['nullable', 'string'],
        ];

        // If type is pharmacy, merge additional pharmacy-specific rules
        if ($this->input('type') === 'pharmacy') {
            $rules = array_merge($rules, [
                'pharmacy.name' => ['required', 'string', 'max:255'],
                'pharmacy.hotline' => ['required', 'string', 'max:20'],
                'pharmacy.is_active' => ['boolean'],
                'pharmacy.is_accept_expired' => ['required', 'boolean'],
                'pharmacy.logo' => ['required', 'image'],
            ]);
        }

        return $rules;
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number is required.',
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
            'type.required' => 'Type is required (user or pharmacy).',
            'name.required' => 'Name is required.',
            'hotline.required' => 'Pharmacy hotline is required for pharmacy registration.',
            'is_accept_expired.required' => 'Please specify if the pharmacy accepts expired drugs.',
        ];
    }
}
