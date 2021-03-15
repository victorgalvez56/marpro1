<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\UserRequest;
use App\Http\Resources\Tenant\PersonUserCollection;
use App\Http\Resources\Tenant\UserResource;
use App\Models\Tenant\Establishment;
use App\Models\Tenant\Module;
use App\Models\Tenant\User;
use App\Http\Resources\Tenant\UserCollection;
use App\Models\Tenant\Person;
use App\Models\Tenant\PersonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DateTime;


class PersonUserController extends Controller
{
    public function tables()
    {
        $module_id = 13;
        $records = User::whereHas('modules', function ($query) use ($module_id) {
            $query->where('module_id', $module_id);
        })->doesnthave('person')->get();

        $users = new UserCollection($records);

        return compact('users');
    }

    public function record($id)
    {
        $record = new UserResource(User::findOrFail($id));

        return $record;
    }

    public function records($personId)
    {
        $records = PersonUser::where("person_id", $personId)->get();

        return new PersonUserCollection($records);
    }


    public function store(Request $request)
    {

        try {
            $result = DB::connection('tenant')->transaction(function () use ($request) {

                $record = PersonUser::where([['user_id', $request->user_id]])->first();

                if ($record) {
                    $supplier = Person::find($record->person_id);
                    return [
                        'success' => false,
                        'message' => "El usuario ya ha sido registrado en la empresa {$supplier->name}"
                    ];
                }

                $id = $request->input('id');
                $person_users = PersonUser::firstOrNew(['id' => $id]);
                $person_users->fill($request->all());
                $person_users->save();

                $user = User::find($request->user_id);
                $user->locked = 0;
                $user->confirmation_date = new DateTime();
                $user->save();

                return [
                    'success' => true,
                    'message' => ($id) ? 'Usuario editado con éxito' : 'Usuario registrado con éxito'
                ];
            });
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        $person_users = PersonUser::findOrFail($id);
        $person_users->delete();

        return [
            'success' => true,
            'message' => 'Usuario eliminado con éxito'
        ];
    }
}
