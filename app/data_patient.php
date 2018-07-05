<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_patient extends Model
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
    'photo_profile',
    'status',
    'medico_id',
    'patient_id'
  ];


}
