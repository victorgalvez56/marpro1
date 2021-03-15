<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Models\PersonUserRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\UserRequest;
use App\Http\Resources\Tenant\UserResource;
use App\Models\Tenant\Establishment;
use App\Models\Tenant\Module;
use App\Models\Tenant\User;
use App\Http\Resources\Tenant\UserCollection;
use App\Models\Tenant\Person;
use App\Models\Tenant\PersonUser;
use App\Notifications\ConfirmationInstructionUserNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Swift_RfcComplianceException;
use Throwable;

class UserController extends Controller
{


    public function data_table()
    {
        $types = [
            ['type' => 'admin', 'description' => 'Administrador'],
            ['type' => 'seller', 'description' => 'Vendedor'],
            ['type' => 'supplier', 'description' => 'Proveedor'],
        ];
        $establishments = Establishment::where('id', auth()->user()->establishment_id)->get();

        return compact('types', 'establishments');
    }

    public function index()
    {
        return view('tenant.users.index');
    }

    public function record($id)
    {
        $record = new UserResource(User::findOrFail($id));
        return $record;
    }

    public function tables()
    {
        $modules = Module::orderBy('order_menu')->get();
        $datasource = [];
        $children = array();

        for ($i = 0; $i < count($modules); $i++) {
            $hasChild = false;
            $expanded = false;
            $isChecked = true;
            if (count($modules[$i]->levels) > 0) :
                for ($j = 0; $j < count($modules[$i]->levels); $j++) {
                    array_push($datasource, ['id' => $modules[$i]->id . '-' . $modules[$i]->levels[$j]->id, 'pid' => $modules[$i]->id, 'name' => $modules[$i]->levels[$j]->description, 'isChecked' => $isChecked]);
                }
            endif;
            /*if (count($modules[$i]->levels) > 0) {
                for ($j = 0; $j < count($modules[$i]->levels); $j++) {
                    array_push($children, ['id'=>$modules[$i]->levels[$j]->id.'-'.$modules[$i]->levels[$j]->description,'label'=>$modules[$i]->levels[$j]->description]);
                }
            }*/

            /*if (count($modules[$i]->levels) > 0) :
                $datasource_1 = [
                    'id' => $modules[$i]->id,
                    'label' => $modules[$i]->description,
                    'children' => $children
                ];
            else :
                $datasource_1 = [
                    'id' => $modules[$i]->id,
                    'label' => $modules[$i]->description
                ];
            endif;*/
            if (count($modules[$i]->levels) > 0) :
                $hasChild = true;
                $expanded = true;
                $isChecked = false;
            endif;
            array_push($datasource,  ['id' => $modules[$i]->id, 'name' => $modules[$i]->description, 'hasChild' => $hasChild, 'expanded' => $expanded, 'isChecked' => $isChecked]);
        }

        $establishments = Establishment::orderBy('description')->get();
        //dd($datasource);
        $types = [['type' => 'admin', 'description' => 'Administrador'], ['type' => 'seller', 'description' => 'Vendedor']];

        return compact('modules', 'establishments', 'types', 'datasource');
    }

    public function store(UserRequest $request)
    {
        $id = $request->input('id');

        if (!$id)  //VALIDAR EMAIL DISPONIBLE
        {
            $verify = User::where('email', $request->input('email'))->first();
            if ($verify) {
                return [
                    'success' => false,
                    'message' => 'Email no disponible. Ingrese otro Email'
                ];
            }
        }

        $user = User::firstOrNew(['id' => $id]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->establishment_id = $request->input('establishment_id');
        $user->type = $request->input('type');
        $user->locked = $request->input('locked');
        if (!$id) {
            $user->api_token = Str::random(50);
            $user->password = bcrypt($request->input('password'));
        } elseif ($request->has('password')) {
            if (config('tenant.password_change')) {
                $user->password = bcrypt($request->input('password'));
            }
        }
        $user->save();

        $first_user = User::select('id')->orderBy('id', 'asc')->first();

        // $levels = collect($request->input('levels'))->where('checked', true)->pluck('id')->toArray();
        // $user->levels()->sync($levels);

        if ($first_user->id != $user->id) {

            $modules = collect($request->input('modules'))->where('checked', true)->pluck('id')->toArray();

            $user->modules()->sync($modules);


            $levels = collect($request->input('levels'))->where('checked', true)->pluck('id')->toArray();
            $user->levels()->sync($levels);
        }

        // dd($user->getModules()->transform(function($row, $key) {
        //     return [
        //         'id' => $row->id,
        //         'privot_id' => $row->pivot,
        //         'privot_user' => $row->pivot->user_id,
        //         'privot_module' => $row->pivot->module_id,

        //     ];
        // }));

        return [
            'success' => true,
            'message' => ($id) ? 'Usuario actualizado' : 'Usuario registrado'
        ];
    }

    public function records(Request $request)
    {
        $records = $this->getRecords($request);
        return new UserCollection($records->paginate(config('tenant.items_per_page')));
    }

    public function getRecords($request)
    {
        $email = $request->email;
        $name = $request->name;
        $type = $request->type;
        $establishment_id = $request->establishment_id;

        $records = User::where('email', 'like', '%' . $email . '%')
            ->where('name', 'like', '%' . $name . '%')
            ->latest();
        if ($type) {
            $records = $records->where('type', $type);
        }
        if ($establishment_id) {
            $records = $records->where('establishment_id', $establishment_id);
        }
        return $records;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return [
            'success' => true,
            'message' => 'Usuario eliminado con éxito'
        ];
    }

    public function send_confirmation($id)
    {
        try {
            //token
            $user = DB::connection('tenant')->transaction(function () use ($id) {
                $user = User::find($id);
                $supplier = $this->getSupplier($id);
                if (!$user->locked) {
                    throw new Exception("El usuario {$user->email} ya confirmo su cuenta");
                }
                $token = $this->token($supplier);
                Notification::send($user, new ConfirmationInstructionUserNotification($user, $token));
                sleep(15);
                return $user;
            });

            return $this->sendResponseResult("Se ha enviado un enlace de confirmación a {$user->email}", true);
        } catch (Exception $ex) {
            return $this->sendResponseResult($ex->getMessage(), false);
        } catch (Throwable $th) {
            return $this->sendResponseResult($th->getMessage(), false);
        } catch (Swift_RfcComplianceException $sf) {
            return $this->sendResponseResult($sf->getMessage(), false);
        };
    }

    public function getSupplier($user_id)
    {
        $person_user = PersonUser::where("user_id", $user_id)->first();
        if (!$person_user) {
            throw new Exception("No se pudo enviar el enlace de confirmación, porque el correo no fue asignado a un proveedor");
        }
        $supplier = Person::where('id', $person_user->person_id)->first();
        return $supplier;
    }

    public function token($supplier)
    {
        $user_register = new PersonUserRegister(
            $supplier->id,
            $supplier->number,
            $supplier->name,
            $supplier->email,
            $supplier->address
        );
        $str = serialize($user_register);
        $token = urlencode(base64_encode($str));
        return $token;
    }
}
