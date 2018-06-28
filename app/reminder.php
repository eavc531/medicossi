<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reminder extends Model
{
  public function medico(){
    return $this->belongsTo('App\medico');
  }


}
