<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CountryRequest;
use App\Http\Resources\Tenant\CountryCollection;
use App\Http\Resources\Tenant\CountryResource;
use App\Models\Tenant\Catalogs\Country;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class CountryController extends Controller
{
    use ResponseHelpers;


    public function records()
    {
        $records = Country::all();

        return new CountryCollection($records);
    }

    public function record($id)
    {
        $record = new CountryResource(Country::findOrFail($id));

        return $record;
    }

    public function store(CountryRequest $request)
    {
        try {
            $country = DB::connection('tenant')->transaction(function () use ($request) {
                $id = $request->input('id');
                $exist = Country::where('id', $id)->first();
                if ($request->status != "updated" && $exist) {
                    throw new Exception("El código {$id} ya se encuentra registrado");
                }
                $country = Country::firstOrNew(['id' => $id]);
                $country->fill($request->all());
                $country->save();
            });

            return $this->sendResponseResult(($request->status == "updated") ? "País editado con éxito " : "País registrado con éxito ", true);
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
                $country = Country::findOrFail($id);
                $country->delete();
            });
            return $this->sendResponseResult("País eliminado con éxito", true);
        } catch (Exception $e) {

            return ($e->getCode() == '23000') ? ['success' => false, 'message' => 'El país esta siendo usado por otros registros, no puede eliminar'] : ['success' => false, 'message' => 'Error inesperado, no se pudo eliminar el páís'];
        }
    }
}
