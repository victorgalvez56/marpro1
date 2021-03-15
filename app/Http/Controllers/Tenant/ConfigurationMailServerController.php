<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\ConfigurationMailServerCollection;
use App\Http\Resources\Tenant\ConfigurationMailServerResource;
use App\Models\Tenant\ConfigurationMailServer;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class ConfigurationMailServerController extends Controller
{

    use ResponseHelpers;

    public function columns()
    {
        return [
            'name' => 'Nombre',
            'username' => 'Usuario'
        ];
    }

    public function index()
    {
        return view('tenant.configuration_mail_servers.index');
    }

    public function record($id)
    {
        $record =  new ConfigurationMailServerResource(ConfigurationMailServer::findOrFail($id));
        return $record;
    }

    public function getRecords(Request $request)
    {

        $records = ConfigurationMailServer::where($request->column, 'like', "%{$request->value}%")
            ->latest();
        return $records;
    }

    public function records(Request $request)
    {
        $records = $this->getRecords($request);
        return new ConfigurationMailServerCollection($records->paginate(config('tenant.items_per_page')));
    }

    public function store(Request $request)
    {
        try {
            $id = $request->input('id');
            $configuration = DB::connection('tenant')->transaction(function () use ($request, $id) {
                if (!$id) {
                    $this->validateConfigurationMailServer($request);
                }
                $configuration = ConfigurationMailServer::firstOrNew(['name' => $request->name]);
                $configuration->fill($request->all());
                $configuration->save();
                return $configuration;
            });
            return $this->sendResponseResult(($id) ? "Configuración {$configuration->name} actualizada " : "Configuración {$configuration->name} registrada ", true);
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
                $row = ConfigurationMailServer::findOrFail($id);
                $row->delete();
            });
            return $this->sendResponseResult("Configurarión  eliminada con éxito", true);
        } catch (Exception $e) {
            return $this->sendResponseResult($e->getMessage(), false);
        }
    }

    public function validateConfigurationMailServer($request)
    {
        $configurations = ConfigurationMailServer::where("name", $request->name)->get();
        if ($configurations->count() > 0) {
            throw new Exception("Ya existe el nombre {$request->name}, ingrese otro nombre");
        }
    }
}
