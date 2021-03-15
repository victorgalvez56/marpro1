<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonUserCollection extends ResourceCollection
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
                'user_id' => $row->user->id,
                'email' => $row->user->email,
            ];
        });
    }
}
