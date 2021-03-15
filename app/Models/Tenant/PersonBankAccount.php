<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Catalogs\BankAccountType;
use App\Models\Tenant\Catalogs\CurrencyType;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class PersonBankAccount extends ModelTenant
{

    public $timestamps = false;

    protected $with = ['currency_type', 'bank_account_type', 'person'];

    protected $fillable = [
        'bank_id',
        'description',
        'number',
        'currency_type_id',
        'bank_account_type_id',
        'person_id',
        'cci',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }

    public function bank_account_type()
    {
        return $this->belongsTo(BankAccountType::class, 'bank_account_type_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
