<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Catalogs\IdentityDocumentType;
use Illuminate\Support\Facades\Storage;

class Company extends ModelTenant
{
    protected $with = ['identity_document_type'];
    protected $fillable = [
        'user_id',
        'identity_document_type_id',
        'number',
        'name',
        'trade_name',
        'soap_send_id',
        'soap_type_id',
        'soap_username',
        'soap_password',
        'soap_url',
        'certificate',
        'certificate_due',
        'logo',
        'detraction_account',
        'operation_amazonia',
        'slogan',
        'img_firm'
    ];

    public function identity_document_type()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'identity_document_type_id');
    }

    public static function active()
    {
        return Company::first();
    }

    public function getSrcLogo()
    {
        if ($this->logo) {
            $path =  'uploads' . DIRECTORY_SEPARATOR . 'logos' . DIRECTORY_SEPARATOR . $this->logo;
            if (Storage::disk('public')->exists($path)) {
                $image =  Storage::disk('public')->path($path);
                // Read image path, convert to base64 encoding
                $image_data = base64_encode(file_get_contents($image));
                // Format the image SRC:  data:{mime};base64,{data};
                $src = 'data: ' . mime_content_type($image) . ';base64,' . $image_data;
                return $src;
            }
        }
        return null;
    }

    public function getFooterExtranetDashboard()
    {
        $path =  'uploads' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'footers' . DIRECTORY_SEPARATOR . $this->number . DIRECTORY_SEPARATOR . 'footerDashboard.html';
        if (Storage::disk('public')->exists($path)) {
            $footer_dashboard_html =  Storage::disk('public')->get($path);
            return $footer_dashboard_html;
        }
        return null;
    }
}
