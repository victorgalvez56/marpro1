<?php

namespace App\Http\Controllers\Tenant;

use App\CoreFacturalo\Helpers\Storage\StorageDocument;
use App\Http\Controllers\Controller;
use App\CoreFacturalo\Facturalo;
use App\CoreFacturalo\Template;
use App\Models\Tenant\Company;
use Mpdf\Mpdf;
use Exception;

class DownloadController extends Controller
{
    use StorageDocument;

    public function downloadExternal($model, $type, $external_id, $format = null)
    {
        $model = "App\\Models\\Tenant\\" . ucfirst($model);
        $document = $model::where('external_id', $external_id)->first();

        if (!$document) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

        if ($format != null) $this->reloadPDF($document, 'invoice', $format);

        return $this->download($type, $document);
    }

    public function downloadExternalPurchase($model, $type, $external_id, $format = null)
    {
        $model = "App\\Models\\Tenant\\" . ucfirst($model);
        $purchase = $model::where('external_id', $external_id)->first();

        if (!$purchase) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

        if ($format != null) $this->reloadPDF($purchase, 'invoice', $format);
        $month = str_pad($purchase->date_of_issue->month, 2, '0', STR_PAD_LEFT);
        $folder = 'purchases' . DIRECTORY_SEPARATOR . $purchase->date_of_issue->year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $purchase->supplier->number . DIRECTORY_SEPARATOR . $purchase->filename;
        return $this->downloadPurchase($type, $folder, $purchase->filename);
    }

    public function download($type, $document)
    {
        switch ($type) {
            case 'pdf':
                $folder = 'pdf';
                break;
            case 'xml':
                $folder = 'signed';
                break;
            case 'cdr':
                $folder = 'cdr';
                break;
            case 'quotation':
                $folder = 'quotation';
                break;
            case 'sale_note':
                $folder = 'sale_note';
                break;

            default:
                throw new Exception('Tipo de archivo a descargar es inválido');
        }

        //borrar despues
        // solo desarrollo
        // $this->reloadPDF($document, 'dispatch', 'a4');
        // $temp = tempnam(sys_get_temp_dir(), 'pdf');
        // file_put_contents($temp, $this->getStorage($document->filename, 'pdf'));

        // return response()->file($temp);
        //borrar antes
        return $this->downloadStorage($document->filename, $folder);
    }

    public function downloadPurchase($type, $folder, $filename)
    {
        switch ($type) {
            case 'pdf':
                $filename = $filename . '.' . $type;
                break;
            case 'xml':
                $filename = $filename . '.' . $type;
                break;
            case 'cdr':
                $filename = 'R-' . $filename . '.xml';
                break;
            default:
                throw new Exception('Tipo de archivo a descargar es inválido');
        }
        // $folder= $folder.DIRECTORY_SEPARATOR.$filename;
        return $this->downloadStoragePurchase($folder, $filename);
    }

    public function toPrint($model, $external_id, $format = null)
    {
        $model = "App\\Models\\Tenant\\" . ucfirst($model);
        $document = $model::where('external_id', $external_id)->first();

        if (!$document) throw new Exception("El código {$external_id} es inválido, no se encontro documento relacionado");

        if (in_array($document->document_type_id, ['01', '03'])) {
            if ($format != null) $this->reloadPDF($document, 'invoice', $format);
        } else {
            if ($format != null) $this->reloadPDF($document, 'note', $format);
        }

        $temp = tempnam(sys_get_temp_dir(), 'pdf');
        file_put_contents($temp, $this->getStorage($document->filename, 'pdf'));

        return response()->file($temp);
    }

    /**
     * Reload PDF
     * @param  ModelTenant $document
     * @param  string $format
     * @return void
     */
    private function reloadPDF($document, $type, $format)
    {
        (new Facturalo)->createPdf($document, $type, $format);
    }
}
