<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'is_admin' => $this->is_admin,
            'country' => new CountryResource($this->country),
            'role' => new RoleResource($this->role),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
