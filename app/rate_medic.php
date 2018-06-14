<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rate_medic extends Model
{
  // public function medico(){
  //    return $this->belongsTo('App\medico');
  // }

  public function patient(){
     return $this->belongsTo('App\patient');
  }

}
