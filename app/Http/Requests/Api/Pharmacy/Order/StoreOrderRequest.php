<?php

namespace App\Http\Requests\Api\Pharmacy\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'drug_id' => ['required', 'exists:drugs,id'],
            'pharmacy_branch_id' => ['required', 'exists:pharmacy_branches,id'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'drug_id' => 'الدواء',
            'pharmacy_branch_id' => 'الصيدلية',
        ];
    }
}
