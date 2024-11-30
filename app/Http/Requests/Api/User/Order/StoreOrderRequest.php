<?php

namespace App\Http\Requests\Api\User\Order;

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
            "pharmacy_branch_id" => ['required', 'exists:pharmacy_branches,id'],
            "drug_ids" => ['required', 'array'],
            "drug_ids.*.drug_id" => ['required', 'exists:drugs,id'],
            "drug_ids.*.quantity" => ['required', 'integer', 'min:1'],
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
            'drug_ids' => 'الأدوية',
            'quantities' => 'الكميات',
            'pharmacy_branch_id' => 'فرع الصيدلية',
        ];
    }
}
