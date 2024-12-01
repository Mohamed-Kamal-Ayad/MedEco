<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Admin */
class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hotline' => $this->hotline,
            'is_active' => $this->is_active,
            'logo' => $this->getFirstMediaUrl('logo'),
            'branches' => $this->whenLoaded('branches', function () {
                return json_decode($this->branches->map(function ($branch) {
                    return [
                        'id' => $branch->id,
                        'address' => $branch->address,
                        'phone' => $branch->phone,
                        'commercial_registration_number' => $branch->commercial_registration_number,
                        'tax_number' => $branch->tax_number,
                        'lat' => $branch->lat,
                        'lng' => $branch->lng,
                        'created_at' => $branch->created_at,
                        'updated_at' => $branch->updated_at
                    ];
                }));
            }),
            'user_id' => $this->user_id,
            'is_accept_expired' => $this->is_accept_expired,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
