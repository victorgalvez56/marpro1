<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{

    public function index()
    {
        return view('tenant.terms_conditions.index');
    }

    public function show()
    {
        $target_path = 'terms_condition' . DIRECTORY_SEPARATOR . 'terms_conditions.html';

        $contentOfTermsAndConditions = Storage::disk('tenant')->get($target_path);
        /* $contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"></head><body>", "", $contentOfTermsAndConditions); */
        //$contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"><meta http-Equiv=\"Cache-Control\" Content=\"no-cache\"><meta http-Equiv=\"Cache-control\" Content=\"no-store\"><meta http-Equiv=\"Pragma\" Content=\"no-cache\"><meta http-Equiv=\"Expires\" Content=\"0\"></head><body>", "", $contentOfTermsAndConditions);
        $contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"><meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\"/><meta http-Equiv=\"Pragma\" Content=\"no-cache\"><meta http-Equiv=\"Expires\" Content=\"0\"></head><body>", "", $contentOfTermsAndConditions);
        $contentOfTermsAndConditions = str_replace("</body><footer></footer></html>", "", $contentOfTermsAndConditions);
        return response()->json(['content' => $contentOfTermsAndConditions]);
    }

    public function write(Request $request)
    {
        $stringToWrite =
            "<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"><meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\"/><meta http-Equiv=\"Pragma\" Content=\"no-cache\"><meta http-Equiv=\"Expires\" Content=\"0\"></head><body>" .
            $request->content .
            "</body><footer></footer></html>";

        $target_path = 'terms_condition' . DIRECTORY_SEPARATOR . 'terms_conditions.html';

        Storage::disk('tenant')->put($target_path, $stringToWrite);
        // file_put_contents("C:/xampp/htdocs/laravel-project-2019/storage/app/public/terminosycondiciones.html", $stringToWrite);
    }

    public function show_html()
    {
        $target_path = 'terms_condition' . DIRECTORY_SEPARATOR . 'terms_conditions.html';

        $contentOfTermsAndConditions = Storage::disk('tenant')->get($target_path);
        /* $contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"></head><body>", "", $contentOfTermsAndConditions); */
        //$contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"><meta http-Equiv=\"Cache-Control\" Content=\"no-cache\"><meta http-Equiv=\"Cache-control\" Content=\"no-store\"><meta http-Equiv=\"Pragma\" Content=\"no-cache\"><meta http-Equiv=\"Expires\" Content=\"0\"></head><body>", "", $contentOfTermsAndConditions);
        //   $contentOfTermsAndConditions = str_replace("<!DOCTYPE html><html lang=\"en\" dir=\"ltr\"><head><meta charset=\"UTF-8\"><meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\"/><meta http-Equiv=\"Pragma\" Content=\"no-cache\"><meta http-Equiv=\"Expires\" Content=\"0\"></head><body>", "", $contentOfTermsAndConditions);
        //   $contentOfTermsAndConditions = str_replace("</body><footer></footer></html>", "", $contentOfTermsAndConditions);
        return response()->json(['content' => $contentOfTermsAndConditions]);

        // return $contentOfTermsAndConditions;
    }
}
