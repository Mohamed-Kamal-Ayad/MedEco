<?php

namespace App\Http\Requests\Api\Pharmacy\Drug;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrugRequest extends FormRequest
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
            'drug_type_id' => ['required', 'exists:drug_types,id'],
            'pharmacy_branch_id' => ['required', 'exists:pharmacy_branches,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required_if:is_donated,0', 'numeric', 'min:0'],
            'qty' => ['required', 'numeric', 'min:0'],
            'production_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date', 'after:production_date'],
            'is_donated' => ['required', 'boolean'],
            'images' => ['sometimes', 'array', 'min:1'],
            'images.*' => ['required_with:images', 'image', 'mimes:jpeg,png,jpg'],
            'lat' => ['sometimes', 'numeric'],
            'lng' => ['sometimes', 'numeric'],
            'is_expired' => ['sometimes', 'boolean'],
        ];
    }

    public $attributes = [
        'drug_type_id' => 'نوع الدواء',
        'pharmacy_branch_id' => 'فرع الصيدلية',
        'name' => 'الاسم',
        'description' => 'الوصف',
        'price' => 'السعر',
        'qty' => 'الكمية',
        'production_date' => 'تاريخ الإنتاج',
        'expiry_date' => 'تاريخ الانتهاء',
        'is_donated' => 'هل الدواء متبرع',
        'images' => 'الصور',
        'lat' => 'خط العرض',
        'lng' => 'خط الطول',
        'is_expired' => 'هل الدواء منتهي',
    ];
}
