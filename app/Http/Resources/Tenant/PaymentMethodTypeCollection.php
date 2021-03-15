<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentMethodTypeCollection extends ResourceCollection
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
            $show_actions = true;

            if (in_array($row->id, ['01', '05', '08', '09'])) {
                $show_actions = false;
            }

            return [
                'id' => $row->id,
                'description' => $row->description,
                'has_card'    => (bool) $row->has_card,
                'number_days' => $row->number_days,
                'charge' => $row->charge,
                'is_purchase' => (bool) $row->is_purchase,
                'is_sale' => (bool) $row->is_sale,
                'show_actions' => $show_actions
            ];
        });
    }
}
