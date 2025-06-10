<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            'patient_name' => $this->patient_name,
            'medications' => MedicationResource::collection($this->whenLoaded('medications')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
