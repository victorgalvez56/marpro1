<?php

namespace App\Http\Controllers\Tenant;

use App\CoreBizag\Core\Utilities\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Company;
use App\Models\Tenant\Configuration;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class BannerController extends Controller
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
        return view('tenant.banners.index');
    }

    public function records()
    {
        $banners = Configuration::getBanners();
        return $banners;
    }


    function upload_image($request)
    {
        $file = $request['file'];
        $type = $request['type'];

        $temp = tempnam(sys_get_temp_dir(), $type);
        file_put_contents($temp, file_get_contents($file));

        $mime = mime_content_type($temp);
        $data = file_get_contents($temp);

        return [
            'success' => true,
            'data' => [
                'filename' => $file->getClientOriginalName(),
                'temp_path' => $temp,
                'temp_image' => 'data:' . $mime . ';base64,' . base64_encode($data)
            ]
        ];
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $new_request = [
                'file' => $request->file('file'),
                'type' => $request->input('type'),
            ];

            return $this->upload_image($new_request);
        }
        return [
            'success' => false,
            'message' =>  __('app.actions.upload.error'),
        ];
    }


    public function store(Request $request)
    {
        try {
            $message = "";
            if ($request->status == 'created') {
                $message = "Banner registrado con éxito";
            } elseif ($request->status == 'updated') {
                $message = "Banner editado con éxito";
            } elseif ($request->status == 'deleted') {
                $message = "Banner eliminado con éxito";
            }
            DB::connection('tenant')->transaction(function () use ($request) {
                $configuration =   Configuration::first();
                $records = [];
                foreach ($request->records as $key => $row) {
                    if (key_exists('is_new', $row) && $row["is_new"]) {
                        $item = $this->save_with_image($row);
                        array_push($records, $item);
                    } else {
                        if (key_exists('is_update', $row) && $row["is_update"]) {
                            $item = $this->update($row);
                            array_push($records, $item);
                        } else {
                            $item = $this->save($row);
                            array_push($records, $item);
                        }
                    }
                }
                $configuration->banners = count($records) > 0 ? $records : null;
                $configuration->save();
            });
            return $this->sendResponseResult($message, true);
        } catch (Throwable $th) {
            return $this->sendResponseResult($th->getMessage(), false);
        } catch (Exception $ex) {
            return $this->sendResponseResult($ex->getMessage(), false);
        }
    }



    public function update($row)
    {
        if (key_exists('is_update_image', $row) && $row["is_update_image"]) {
            $item = $this->save_with_image($row);
            return $item;
        } else {
            $item = $this->save($row);
            return $item;
        }
    }

    public function save_with_image($row)
    {
        $company = Company::active();
        $temp_path = $row['temp_path'];
        if ($temp_path) {
            $image_extension = strtolower(pathinfo($row['image'], PATHINFO_EXTENSION));
            $extension_allowed = ["png", "jpg", "jpeg"];
            if (!in_array($image_extension, $extension_allowed)) {
                throw new Exception("Ingrese imagenes en formato .jpg, .png, .jpge");
            }
            $directory = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . $company->number . DIRECTORY_SEPARATOR . 'banners' . DIRECTORY_SEPARATOR;
            $file_name_old = $row['image'];
            $file_name_old_array = explode('.', $file_name_old);
            $file_content = file_get_contents($temp_path);
            $datenow = date('YmdHis');
            $file_name = Str::slug($file_name_old_array[0])  . $datenow . '.' . $file_name_old_array[1];
            Storage::put($directory . $file_name, $file_content);
            $item = [
                "image_url" => "{$company->number}" . DIRECTORY_SEPARATOR . "banners" . DIRECTORY_SEPARATOR . "{$file_name}",
                "links" => $row["links"]
            ];
            return $item;
        } else {
            throw new Exception("No se pudo cargar la imagen");
        }
    }

    public function save($row)
    {
        $item = [
            "image_url" => $row["image_url"],
            "links" => $row["links"]
        ];
        return $item;
    }
}
