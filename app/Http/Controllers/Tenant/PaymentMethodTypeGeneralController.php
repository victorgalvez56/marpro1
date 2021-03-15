<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Models\Tenant\PaymentMethodType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\PaymentMethodTypeRequest;
use App\Http\Resources\Tenant\PaymentMethodTypeCollection;
use App\Http\Resources\Tenant\PaymentMethodTypeResource;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class PaymentMethodTypeGeneralController extends Controller
{

    use ResponseHelpers;

    public function columns()
    {
        return [
            'id' => 'Id',
            'description' => 'Descripción',
        ];
    }


    public function index($type)
    {
        return view('tenant.payment_method_types_general.index', compact('type'));
    }

    public function record($id)
    {
        $record =  new PaymentMethodTypeResource(PaymentMethodType::findOrFail($id));
        return $record;
    }

    public function getRecords($type, Request $request)
    {

        if ($type == 'sale') {
            $records = PaymentMethodType::where($request->column, 'like', "%{$request->value}%");
            return $records;
        }

        if ($type == 'purchase') {
            $records = PaymentMethodType::where('is_purchase', true);
            return $records;
        }
    }

    public function records($type, Request $request)
    {
        $records = $this->getRecords($type, $request);
        return new PaymentMethodTypeCollection($records->paginate(config('tenant.items_per_page')));
    }

    public function store(PaymentMethodTypeRequest $request)
    {
        try {
            $id = $request->input('id');
            $exist = PaymentMethodType::find($id);
            $payment_method_type = DB::connection('tenant')->transaction(function () use ($request, $id) {
                $payment_method_type = PaymentMethodType::firstOrNew(['id' => $id]);
                $payment_method_type->fill($request->all());
                $payment_method_type->save();
                return $payment_method_type;
            });
            return $this->sendResponseResult(($exist) ? "Método de pago editado con éxito" : "Método de pago registrado con éxito", true);
        } catch (Throwable $th) {
            return $this->sendResponseResult($th->getMessage(), false);
        } catch (Exception $ex) {
            return $this->sendResponseResult($ex->getMessage(), false);
        }
    }

    public function destroy($id)
    {
        try {
            DB::connection('tenant')->transaction(function () use ($id) {
                $record = PaymentMethodType::findOrFail($id);
                $record->delete();
            });

            return $this->sendResponseResult("Método de pago eliminada con éxito", true);
        } catch (Exception $e) {
            return ($e->getCode() == '23000') ? ['success' => false, 'message' => 'El método de pago esta siendo usada por otros registros, no puede eliminar'] : ['success' => false, 'message' => 'Error inesperado, no se pudo eliminar'];
        }
    }
}
