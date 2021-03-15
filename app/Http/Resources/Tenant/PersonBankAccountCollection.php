<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonBankAccountCollection extends ResourceCollection
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
                // 'description' => $row->description,
                'number' => $row->number,
                'cci' => $row->cci,
                'bank_id' => $row->bank->id,
                'bank_description' => $row->bank->description,
                'currency_type_id' => $row->currency_type->id,
                'currency_type_description' => $row->currency_type->description,
                'bank_account_type_id' => $row->bank_account_type->id,
                'bank_account_type_description' => $row->bank_account_type->description,
                'person_name' => $row->person->name,
            ];
        });
    }
}
