<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Configuration;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class DiscardController extends Controller
{
    use ResponseHelpers;

    public function index()
    {
        return view('tenant.discards.index');
    }

    public function tables()
    {
        $documents = [
            ["id" => 1,  "value" => 'purchase_quote', "description" => "Cotización"],

        ];
        //purchase quote dates
        $purchase_quote_dates =   [
            ["id" => 1, "value" => 'date_of_due', "description" => "Válido hasta"],
            ["id" => 2, "value" => 'sent_date', "description" => "Fecha de envío"],
            ["id" => 3, "value"  => 'received_date', "description" => "Fecha de recepción"],
        ];
        //purchase order dates
        $purchase_order_dates =   [
            ["id" => 1,  "value"  => 'created_at', "description" => "Fecha de registro"],
            ["id" => 2, "value" => 'date_of_issue', "description" => "Fecha de emisión"],
            ["id" => 3, "value" => 'sent_date', "description" => "Fecha de envío"],
        ];

        return compact('documents', 'purchase_quote_dates', 'purchase_order_dates');
    }

    public function records()
    {
        $discards = Configuration::first()->discards;
        $discards_tmp = [];
        if (is_object($discards)) {
            foreach ($discards as $discard) {
                $discards_tmp[] = [
                    "document" => $discard->document,
                    "date_from" => $discard->date_from,
                    "number_days" => $discard->number_days,
                    "purchase_order_date_from" => $discard->purchase_order_date_from,
                    "purchase_order_number_days" => $discard->purchase_order_number_days,
                    "is_automatic" => (bool) $discard->is_automatic,
                ];
            }
        }
        return $discards_tmp;
    }

    public function store(Request $request)
    {
        try {
            $message = "";
            if ($request->status == 'created') {
                $message = "Configuración registrada con éxito";
            } elseif ($request->status == 'updated') {
                $message = "Configuración editada con éxito";
            } elseif ($request->status == 'deleted') {
                $message = "Configuración eliminada con éxito";
            }
            DB::connection('tenant')->transaction(function () use ($request) {
                $configuration =   Configuration::first();
                $configuration->discards = count($request->records) > 0 ? $request->records : null;
                $configuration->save();
            });
            return $this->sendResponseResult($message, true);
        } catch (Throwable $th) {
            return $this->sendResponseResult($th->getMessage(), false);
        } catch (Exception $ex) {
            return $this->sendResponseResult($ex->getMessage(), false);
        }
    }
}
