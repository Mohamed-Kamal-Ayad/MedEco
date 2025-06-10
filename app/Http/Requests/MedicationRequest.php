<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'medicine_name' => 'required|string|max:255',
                'dosage' => 'required|string|max:255',
                'start_date' => 'required|date',

                'frequency_type' => 'required|in:daily,weekly,monthly,every_x_days',
                'frequency_count' => 'required|integer|min:1',
                'specific_times' => [
                    'required_if:frequency_type,daily',
                    'array',
                    'exclude_if:frequency_type,weekly,monthly,every_x_days',
                    function ($attribute, $value, $fail) {
                        if ($this->input('frequency_type') === 'daily' && count($value) < 1) {
                            $fail('At least one specific time must be provided for daily medications.');
                        }
                    },
                ],
                'specific_times.*' => 'string|date_format:H:i',
                'specific_days' => [
                    'required_if:frequency_type,weekly,monthly',
                    'array',
                    'exclude_if:frequency_type,daily,every_x_days',
                    function ($attribute, $value, $fail) {
                        if (in_array($this->input('frequency_type'), ['weekly', 'monthly']) && count($value) < 1) {
                            $fail('At least one specific day must be provided for weekly or monthly medications.');
                        }
                    },
                ],

                'duration_type' => 'required|in:days,weeks,months,indefinite',
                'duration_value' => [
                    'required_if:duration_type,days,weeks,months',
                    'nullable',
                    'integer',
                    'min:1',
                ],
            ];
        }

        return [
            'medicine_name' => 'sometimes|string|max:255',
            'dosage' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'frequency_type' => 'sometimes|in:daily,weekly,monthly,every_x_days',
            'frequency_count' => 'sometimes|integer|min:1',
            'specific_times' => [
                'sometimes',
                'required_if:frequency_type,daily',
                'array',
                'exclude_if:frequency_type,weekly,monthly,every_x_days',
                function ($attribute, $value, $fail) {
                    if ($this->has('frequency_type') && $this->input('frequency_type') === 'daily' && count($value) < 1) {
                        $fail('At least one specific time must be provided for daily medications.');
                    }
                },
            ],
            'specific_times.*' => 'string|date_format:H:i',
            'specific_days' => [
                'sometimes',
                'required_if:frequency_type,weekly,monthly',
                'array',
                'exclude_if:frequency_type,daily,every_x_days',
                function ($attribute, $value, $fail) {
                    if ($this->has('frequency_type') && in_array($this->input('frequency_type'), ['weekly', 'monthly']) && count($value) < 1) {
                        $fail('At least one specific day must be provided for weekly or monthly medications.');
                    }
                },
            ],

            'duration_type' => 'sometimes|in:days,weeks,months,indefinite',
            'duration_value' => [
                'sometimes',
                'required_if:duration_type,days,weeks,months',
                'nullable',
                'integer',
                'min:1',
            ],
        ];
    }





    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'medicine_name.required' => 'The medicine name field is required.',
            'dosage.required' => 'The dosage field is required.',
            'frequency_type.required' => 'The frequency type field is required.',
            'frequency_type.in' => 'The frequency type must be one of: daily, weekly, monthly, or every_x_days.',
            'frequency_count.required' => 'The frequency count field is required.',
            'frequency_count.min' => 'The frequency count must be at least 1.',
            'specific_times.required_if' => 'The specific times are required for daily medications.',
            'specific_times.min' => 'At least one specific time must be provided for daily medications.',
            'specific_times.*.date_format' => 'Each specific time must be in the format HH:MM.',
            'specific_days.required_if' => 'The specific days are required for weekly or monthly medications.',
            'specific_days.min' => 'At least one specific day must be provided for weekly or monthly medications.',
            'duration_type.required' => 'The duration type field is required.',
            'duration_type.in' => 'The duration type must be one of: days, weeks, months, or indefinite.',
            'duration_value.required_if' => 'The duration value is required unless the duration type is indefinite.',
            'duration_value.min' => 'The duration value must be at least 1.',
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date.',
        ];
    }
}
