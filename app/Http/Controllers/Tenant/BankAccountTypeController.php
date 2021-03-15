<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\BankAccountTypeRequest;
use App\Http\Resources\Tenant\BankAccountTypeCollection;
use App\Http\Resources\Tenant\BankAccountTypeResource;
use App\Models\Tenant\Catalogs\BankAccountType;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class BankAccountTypeController extends Controller
{
    use ResponseHelpers;

    public function records()
    {
        $records = BankAccountType::all();

        return new BankAccountTypeCollection($records);
    }

    public function record($id)
    {
        $record = new BankAccountTypeResource(BankAccountType::findOrFail($id));

        return $record;
    }

    public function store(BankAccountTypeRequest $request)
    {
        try {
            $bank_account_type = DB::connection('tenant')->transaction(function () use ($request) {
                $id = $request->input('id');
                $exist = BankAccountType::where('id', $id)->first();
                if ($request->status != "updated" && $exist) {
                    throw new Exception("El código {$id} ya se encuentra registrado");
                }
                $bank_account_type = BankAccountType::firstOrNew(['id' => $id]);
                $bank_account_type->fill($request->all());
                $bank_account_type->save();
                return $bank_account_type;
            });
            return $this->sendResponseResult(($request->status == "updated") ? "Tipo de cuenta bancaria editada con éxito " : "Tipo de cuenta bancaria registrada con éxito ", true);
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
                $record = BankAccountType::findOrFail($id);
                $record->delete();
            });
            return $this->sendResponseResult("Tipo de cuenta bancaria  eliminada con éxito", true);
        } catch (Exception $e) {
            return ($e->getCode() == '23000') ? ['success' => false, 'message' => 'El tipo de cuenta bancaria esta siendo usada por otros registros, no puede eliminar'] : ['success' => false, 'message' => 'Error inesperado, no se pudo eliminar la unidad'];
        }
    }
}
