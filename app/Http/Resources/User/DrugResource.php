<?php

namespace App\Http\Resources\User;

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
            'price' => $this->price,
            'qty' => $this->qty,
            'production_date' => $this->production_date,
            'expiry_date' => $this->expiry_date,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'pharmacy_branch' => $this->pharmacy_branch_id ? [
                'id' => $this->pharmacyBranch->id,
                'name' => $this->pharmacyBranch->name,
                'address' => $this->pharmacyBranch->address,
                'pharmacy' => [
                    'id' => $this->pharmacyBranch->pharmacy->id,
                    'name' => $this->pharmacyBranch->pharmacy->name,
                    'hotline' => $this->pharmacyBranch->pharmacy->hotline,
                    'logo' => $this->pharmacyBranch->pharmacy->getFirstMediaUrl('logo'),
                ],
            ] : null,
            'is_donated' => $this->is_donated,
            'images' => $this->getMedia('images')->map(function ($image) {
                return $image->getFullUrl();
            }),
            'created_at' => $this->created_at,
        ];
    }
}
