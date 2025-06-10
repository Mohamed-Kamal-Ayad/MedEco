<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
        $rules = [
            'medicine_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency_type' => 'required|in:daily,weekly,monthly,every_x_days',
            'frequency_count' => 'required|integer|min:1',
            'duration_type' => 'required|in:days,weeks,months,indefinite',
            'start_date' => 'required|date',
        ];
        
        // Conditional validation rules
        if ($this->input('frequency_type') === 'daily') {
            $rules['specific_times'] = 'required|array|min:1';
            $rules['specific_times.*'] = 'string|date_format:H:i';
        }
        
        if (in_array($this->input('frequency_type'), ['weekly', 'monthly'])) {
            $rules['specific_days'] = 'required|array|min:1';
        }
        
        if ($this->input('duration_type') !== 'indefinite') {
            $rules['duration_value'] = 'required|integer|min:1';
        } else {
            $rules['duration_value'] = 'nullable';
        }
        
        return $rules;
    }
}
