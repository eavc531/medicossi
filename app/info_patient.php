<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class info_patient extends Model
{
  protected $fillable = [
    'identification',
    'gender',
    'name',
    'lastName',
    'nameComplete',
    'phone1',
    'phone2',
    'email',
    'age',
    'birthdate',
    'postal_code',
    'city',
    'state',
    'country',
    'colony',
    'street',
    'number_ext',
    'number_int',
    'latitud',
    'longitud',
  ];
}
