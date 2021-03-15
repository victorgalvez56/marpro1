<?php

namespace App\Http\Resources\Tenant;


use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodTypeResource extends JsonResource
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
            'description' => $this->description,
            'has_card' => (bool) $this->has_card,
            'number_days' => $this->number_days,
            'charge' => $this->charge,
            'is_purchase' => (bool) $this->is_purchase,
            'is_sale' => (bool) $this->is_sale,
        ];
    }
}
