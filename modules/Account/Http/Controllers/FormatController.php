<?php

namespace Modules\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function index()
    {
        return view('account::account.format');
    }

    public function download(Request $request)
    {
        $type = $request->input('type');
        $month = $request->input('month');
        $d_start = Carbon::parse($month . '-01')->format('Y-m-d');
        $d_end = Carbon::parse($month . '-01')->endOfMonth()->format('Y-m-d');
    }

    private function getCompany()
    {
        $company = Company::query()->first();

        return [
            'name' => $company->name,
            'number' => $company->number,
        ];
    }
}
