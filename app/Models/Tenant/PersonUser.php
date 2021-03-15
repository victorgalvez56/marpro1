<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class PersonUser extends ModelTenant
{

    protected $with = ['person', 'user'];


    protected $fillable = [
        'user_id', 'person_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
