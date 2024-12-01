<?php

namespace App\Http\Resources\Pharmacy;

use App\Http\Resources\OrderItemResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'order_items' => OrderItemResource::collection($this->items),
            'is_completed' => $this->is_completed,
            'created_at' => $this->created_at,
            'user' => UserResource::make($this->user),
            'points_earned' => $this->total,
        ];
    }
}
