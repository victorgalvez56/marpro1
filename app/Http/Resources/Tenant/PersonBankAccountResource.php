<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonBankAccountResource extends JsonResource
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
            // 'description' => $this->description,
            'number' => $this->number,
            'cci' => $this->cci,
            'bank_id' => $this->bank_id,
            'currency_type_id' => $this->currency_type_id,
            'bank_account_type_id' => $this->bank_account_type_id,
            'person_id' => $this->person_id
        ];
    }
}
