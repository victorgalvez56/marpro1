<?php

namespace App\Models\Tenant;

use App\CoreBizag\Core\Enum\States;

class Configuration extends ModelTenant
{
    protected $fillable = [
        'send_auto',
        'formats',
        'cron',
        'stock',
        'locked_emission',
        'locked_users',
        'limit_documents',
        'sunat_alternate_server',
        'plan',
        'visual',
        'enable_whatsapp',
        'phone_whatsapp',
        'limit_users',
        'quantity_documents',
        'date_time_start',
        'locked_tenant',
        'compact_sidebar',
        'decimal_quantity',
        'amount_plastic_bag_taxes',
        'colums_grid_item',
        'options_pos',
        'edit_name_product',
        'restrict_receipt_date',
        'affectation_igv_type_id',
        'terms_condition',
        'cotizaction_finance',
        'include_igv',
        'product_only_location',
        'header_image',
        'legend_footer',
        'banners',
        'discards',
        'default_document_type_03',
        'destination_sale',
        'terms_condition_sale'
    ];

    public function setPlanAttribute($value)
    {
        $this->attributes['plan'] = (is_null($value)) ? null : json_encode($value);
    }

    public function getPlanAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function setVisualAttribute($value)
    {
        $this->attributes['visual'] = (is_null($value)) ? null : json_encode($value);
    }

    public function getVisualAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function getDiscardsAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function setDiscardsAttribute($value)
    {
        $this->attributes['discards'] = (is_null($value)) ? null : json_encode($value);
    }


    public function getBannersAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function setBannersAttribute($value)
    {
        $this->attributes['banners'] = (is_null($value)) ? null : json_encode($value);
    }

    public static function getBanners()
    {
        $banners_tmp = [];
        $banners = Configuration::first()->banners;
        if (is_object($banners)) {
            foreach ($banners as $banner) {
                $banners_tmp[] = [
                    "image_url" => $banner->image_url,
                    'src_image' => asset('storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . $banner->image_url),
                    "links" => Configuration::convertLinks($banner->links)
                ];
            }
        }
        return $banners_tmp;
    }

    public static function convertLinks($links)
    {
        $links_tmp = [];
        foreach ($links as $link) {
            $array_style = explode(";", $link->style);
            $top = explode(":", $array_style[1])[1];
            $right = explode(":", $array_style[2])[1];
            $height = explode(":", $array_style[3])[1];
            $width = explode(":", $array_style[4])[1];
            $css = "";
            for ($i = 5; $i < count($array_style); $i++) {
                $css .=   count($array_style) === $i + 1 ? $array_style[$i] : $array_style[$i] . ';';
            }

            $links_tmp[] = [
                "href" => $link->href,
                'style' => $link->style,
                "top" => str_replace(array('%'), '', $top),
                "right" => str_replace(array('%'), '', $right),
                "height" => str_replace(array('%'), '', $height),
                "width" => str_replace(array('%'), '', $width),
                "css" => $css,
            ];
        }
        return $links_tmp;
    }

    public static function keyAndValueStates()
    {
        $states = [
            "sent_date" => States::SENT,
            "received_date" => States::RECEIVED
        ];

        return $states;
    }
}
