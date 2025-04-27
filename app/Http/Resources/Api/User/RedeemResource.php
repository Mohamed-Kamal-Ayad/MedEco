<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\PharmacyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RedeemResource extends JsonResource
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
            'user_id' => $this->user_id,
            'pharmacy_id' => $this->pharmacy_id,
            'points' => $this->points,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pharmacy' => new PharmacyResource($this->whenLoaded('pharmacy')),
        ];
    }
}
