<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'type' => ['required', 'in:user,pharmacy'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'type.required' => 'User type is required (user or pharmacy)',
            'type.in' => 'Invalid user type. Must be either user or pharmacy',
        ];
    }
}
