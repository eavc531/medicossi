<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{

  protected $fillable = [
    'identification',
    'name',
    'lastName',
    'phone1',
    'phone2',
    'email',
    'dateActivation',
    'status',
    'gender',
    'birthdate'
  ];
}
