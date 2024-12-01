<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Admin */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'points' => $this->points,
            'avatar' => $this->getAvatar(),
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'national_id' => $this->national_id,
            'created_at' => $this->created_at,
        ];
    }
}
