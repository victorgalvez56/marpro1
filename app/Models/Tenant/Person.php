<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Catalogs\Country;
use App\Models\Tenant\Catalogs\Department;
use App\Models\Tenant\Catalogs\District;
use App\Models\Tenant\Catalogs\IdentityDocumentType;
use App\Models\Tenant\Catalogs\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Person extends ModelTenant
{
    use Notifiable;
    protected $table = 'persons';
    protected $with = ['identity_document_type', 'country', 'department', 'province', 'district', 'users'];
    protected $fillable = [
        'type',
        'identity_document_type_id',
        'number',
        'name',
        'trade_name',
        'country_id',
        'department_id',
        'province_id',
        'district_id',
        'address',
        'email',
        'telephone',
        'perception_agent',
        'state',
        'condition',
        'is_reception',
        'is_extranet',
        'percentage_perception',
        'person_type_id',
        'comment',
        'enabled',
        'contact',
        'logo',
        'internal_code',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('active', function (Builder $builder) {
    //         $builder->where('status', 1);
    //     });
    // }

    public function addresses()
    {
        return $this->hasMany(PersonAddress::class);
    }
    public function identity_document_type()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'identity_document_type_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function scopeWhereType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getAddressFullAttribute()
    {
        $address = trim($this->address);
        $address = ($address === '-' || $address === '') ? '' : $address . ' ,';
        if ($address === '') {
            return '';
        }
        return "{$address} {$this->department->description} - {$this->province->description} - {$this->district->description}";
    }

    public function more_address()
    {
        return $this->hasMany(PersonAddress::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'person_users');
    }

    public function person_type()
    {
        return $this->belongsTo(PersonType::class);
    }

    public function scopeWhereIsEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function getContactAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = (is_null($value)) ? null : json_encode($value);
    }

    public function getContactsAttribute($value)
    {
        return (is_null($value)) ? null : (object) json_decode($value);
    }

    public function setContactsAttribute($value)
    {
        $this->attributes['contacts'] = (is_null($value)) ? null : json_encode($value);
    }

    //purchase compliances
    public function purchase_compliances()
    {
        return $this->hasMany(PurchaseCompliance::class);
    }

    //Logo
    public function getSrcLogoAttribute()
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

    //Notification
    public function getCompanyAttribute()
    {
        $company = Company::active();
        return $company;
    }

    //Notification
    public function getEstablishmentAttribute()
    {
        $establishment = Establishment::first();
        return $establishment;
    }

    // public function routeNotificationForMail($notification)
    // {
    //     return $this->email;
    // }

    protected $appends = ['location_id'];

    public function getLocationIdAttribute()
    {
        $location_id = [];
        if ($this->department_id && $this->province_id && $this->district_id) {
            array_push($location_id, $this->department_id, $this->province_id, $this->district_id);
        }
        return $location_id;
    }
}
