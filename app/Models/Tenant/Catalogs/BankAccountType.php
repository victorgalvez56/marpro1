<?php

namespace App\Models\Tenant\Catalogs;

use Hyn\Tenancy\Traits\UsesTenantConnection;

class BankAccountType extends ModelCatalog
{
    use UsesTenantConnection;

    protected $table = "cat_bank_account_types";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'description',
        'active',
    ];
}
