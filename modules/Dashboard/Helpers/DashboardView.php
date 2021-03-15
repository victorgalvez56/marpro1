<?php

namespace Modules\Dashboard\Helpers;

use App\Models\Tenant\Establishment;
use App\Models\Tenant\DocumentPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardView
{
    public static function getEstablishments()
    {
        return Establishment::all()->transform(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->description
            ];
        });
    }
}
