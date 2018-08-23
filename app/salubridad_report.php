<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salubridad_report extends Model
{
    //
    protected $fillable = [
        'diagnostic',
        'identification',
        'nameComplete',
        'phone1',
        'phone2',
        'email',
        'gender',
        'age',
        'city',
        'state',
        'country',
        'birthdate',
        'status',
    ];


}
