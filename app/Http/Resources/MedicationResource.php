<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medicine_name' => $this->medicine_name,
            'dosage' => $this->dosage,
            'frequency_type' => $this->frequency_type,
            'frequency_count' => $this->frequency_count,
            'specific_times' => $this->specific_times,
            'specific_days' => $this->specific_days,
            'duration_type' => $this->duration_type,
            'duration_value' => $this->duration_value,
            'start_date' => $this->start_date,
            'created_at' => $this->created_at,
        ];
    }
}
