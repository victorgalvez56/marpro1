<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'person_id' => $this->person_id,
            'country_id' => $this->country_id,
            'department_id' => $this->deparment_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'main' => (bool) $this->main,

        ];
    }
}
