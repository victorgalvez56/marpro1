<?php

namespace App\Models\Tenant;

use App\CoreBizag\Core\Common\FunctionsMailer;
use App\Mail\Tenant\ResetPasswordMail;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\LevelAccess\Models\ModuleLevel;
use Modules\Sale\Models\UserCommission;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use Notifiable, UsesTenantConnection;

    protected $with = ['establishment'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'establishment_id',
        'type',
        'locked',
        'identity_document_type_id',
        'number',
        'address',
        'telephone',
        'confirmation_date'
    ];

    protected $casts = [
        'confirmation_date' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }

    public function levels()
    {
        return $this->belongsToMany(ModuleLevel::class);
    }

    public function authorizeModules($modules)
    {
        if ($this->hasAnyModule($modules)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyModule($modules)
    {
        if (is_array($modules)) {
            foreach ($modules as $module) {
                if ($this->hasModule($module)) {
                    return true;
                }
            }
        } else {
            if ($this->hasModule($modules)) {
                return true;
            }
        }
        return false;
    }

    public function hasModule($module)
    {
        if ($this->modules()->where('name', $module)->first()) {
            return true;
        }
        return false;
    }



    public function getModule()
    {
        $module = $this->modules()->orderBy('id')->first();
        if ($module) {
            return $module->value;
        }
        return null;
    }

    public function getModules()
    {
        $modules = $this->modules()->get();
        if ($modules) {
            return $modules;
        }
        return null;
    }


    public function searchModule($module)
    {
        if ($this->modules()->where('value', $module)->first()) {
            return true;
        }
        return false;
    }


    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function scopeWhereTypeUser($query)
    {
        $user = auth()->user();
        return ($user->type == 'seller') ? $query->where('id', $user->id) : null;
    }


    public function getLevel()
    {
        $level = $this->levels()->orderBy('id')->first();
        if ($level) {
            return $level->value;
        }
        return null;
    }

    public function getLevels()
    {
        $levels = $this->levels()->get();
        if ($levels) {
            return $levels;
        }
        return null;
    }

    public function searchLevel($Level)
    {
        if ($this->levels()->where('value', $Level)->first()) {
            return true;
        }
        return false;
    }

    public function user_commission()
    {
        return $this->hasOne(UserCommission::class);
    }

    public function getSupplier()
    {
        $person_user = PersonUser::where("user_id", $this->id)->first();
        $supplier = Person::where('id', $person_user->person_id)->first();
        return $supplier;
    }

    public function person()
    {
        return $this->hasOne(PersonUser::class);
    }

    // public function persons()
    // {
    //     return $this->belongsToMany(Person::class, 'person_users');
    // }

    //Notification
    public function getCompanyAttribute()
    {
        $company = Company::active();
        return $company;
    }

    //email send
    public function getEmailSendAttribute()
    {
        return $this->email;
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        FunctionsMailer::sendMailerModel(new ResetPasswordMail($this->email, $token));
        // $this->notify(new ResetPassword($token));
    }
}
