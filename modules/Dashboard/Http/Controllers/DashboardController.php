<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Helpers\DashboardView;
use Modules\Dashboard\Helpers\DashboardStock;
use App\Models\Tenant\Company;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DashboardController extends Controller
{
    public function index()
    {
        // if (auth()->user()->type != 'admin' || !auth()->user()->searchModule('dashboard'))
        //     return redirect()->route('tenant.documents.index');

        $company = Company::select('soap_type_id')->first();
        $soap_company  = $company->soap_type_id;

        return view('dashboard::index', compact('soap_company'));
    }

    public function filter()
    {
        return [
            'establishments' => DashboardView::getEstablishments()
        ];
    }

    public function stockByProduct(Request $request)
    {
        return (new DashboardStock())->data($request);
    }

    public function df()
    {
        $path = app_path();
        //df -m -h --output=used,avail,pcent /

        $used = new Process(array('df', '-m -h --output=used /'));

        $used->run();
        if (!$used->isSuccessful()) {
            return ['error'];
            throw new ProcessFailedException($used);
        }
        $disc_used = $used->getOutput();
        $array[] = str_replace("\n", "", $disc_used);

        $avail = new Process(array('df', '-m -h --output=avail /'));
        $avail->run();
        if (!$avail->isSuccessful()) {
            return ['error'];
            throw new ProcessFailedException($avail);
        }
        $disc_avail = $avail->getOutput();
        $array[] = str_replace("\n", "", $disc_avail);

        $pcent = new Process(array('df', '-m -h --output=pcent /'));
        $pcent->run();
        if (!$pcent->isSuccessful()) {
            return ['error'];
            throw new ProcessFailedException($pcent);
        }
        $disc_pcent = $pcent->getOutput();
        $array[] = str_replace("\n", "", $disc_pcent);

        return $array;
    }
}
