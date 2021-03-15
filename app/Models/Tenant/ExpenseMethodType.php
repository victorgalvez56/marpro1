<?php

namespace App\Models\Tenant;

use App\Models\Tenant\ModelTenant;

class ExpenseMethodType extends ModelTenant
{
    public $timestamps = false;

    protected $fillable = [
        'description',
        'has_card',
    ];
}
