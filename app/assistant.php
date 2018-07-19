<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assistant extends Model
{

  protected $fillable = [
    'identification',
    'name',
    'lastName',

    'status',
    'phone1',
    'phone2',
    'email',
    'dateActivation',
  ];





  public function medico(){
     return $this->belongsTo('App\medico');
  }

}
