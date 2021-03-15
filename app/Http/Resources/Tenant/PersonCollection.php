<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
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
                'number' => $row->number,
                'name' => $row->name,
                'internal_code' => $row->internal_code,
                'document_type' => $row->identity_document_type->description,
                'enabled' => (bool) $row->enabled,
                'is_reception' => (bool) $row->is_reception,
                'is_extranet' => (bool) $row->is_extranet,
                'is_invited' => (bool) $row->users->count() > 0,
                'created_at' => $row->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $row->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }
}
