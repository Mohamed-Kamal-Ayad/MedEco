<?php

namespace App\Http\Resources\Pharmacy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrugResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'drug_type' => [
                'id' => $this->drugType->id,
                'name' => $this->drugType->name,
                'unit' => $this->drugType->unit,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
            ],
            'price' => $this->price,
            'qty' => $this->qty,
            'production_date' => $this->production_date,
            'expiry_date' => $this->expiry_date,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'is_donated' => $this->is_donated,
            'images' => $this->getMedia('images')->map(function ($image) {
                return $image->getFullUrl();
            }),
            'created_at' => $this->created_at,
        ];
    }
}
