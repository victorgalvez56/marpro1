<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Requests\Tenant\PaymentMethodTypeRequest;
use App\Http\Resources\Tenant\PaymentMethodTypeCollection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Tenant\PaymentMethodType;
use Exception;

class PaymentMethodTypeController extends Controller
{

    public function records(Request $request)
    {
        $records = PaymentMethodType::get();

        return new PaymentMethodTypeCollection($records);
    }


    public function record($id)
    {
        $record = PaymentMethodType::findOrFail($id);

        return $record;
    }

    public function store(PaymentMethodTypeRequest $request)
    {

        $id = $request->input('id');
        $record = PaymentMethodType::firstOrNew(['id' => $id]);
        $record->fill($request->all());
        $record->save();


        return [
            'success' => true,
            'message' => ($id) ? 'Método de pago editado con éxito' : 'Método de pago registrado con éxito',
        ];
    }

    public function destroy($id)
    {
        try {

            $record = PaymentMethodType::findOrFail($id);
            $record->delete();

            return [
                'success' => true,
                'message' => 'Método de pago eliminado con éxito'
            ];
        } catch (Exception $e) {

            return ($e->getCode() == '23000') ? ['success' => false, 'message' => "El Método de pago esta siendo usado por otros registros, no puede eliminar"] : ['success' => false, 'message' => "Error inesperado, no se pudo eliminar el Método de pago "];
        }
    }
}
