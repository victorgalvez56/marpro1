<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonAddressCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($row, $key) {
            return [
                'id' => $row->id,
                'person_id' => $row->person->id,
                'person_description' => $row->person->description,
                'country_id' => $row->country_id,
                'country_description' => $row->country ? $row->country->description : null,
                'department_id' => $row->department_id,
                'department_description' => $row->department ? $row->department->description : null,
                'province_id' => $row->province_id,
                'province_description' => $row->province ? $row->province->description : null,
                'district_id' => $row->district_id,
                'district_description' => $row->district ? $row->district->description : null,
                'address' => $row->address,
                'phone' => $row->phone,
                'email' => $row->email,
                'main' => (bool) $row->main,
            ];
        });
    }
}
