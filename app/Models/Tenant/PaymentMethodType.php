<?php

namespace App\Models\Tenant;


class PaymentMethodType extends ModelTenant
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'description',
        'has_card',
        'charge',
        'number_days',
        'is_purchase',
        'is_sale'
    ];
}
