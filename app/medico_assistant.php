<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medico_assistant extends Model
{
    public function medico(){
      return $this->belongsTo('App\medico');
    }

    public function assistant(){
      return $this->belongsTo('App\assistant');
    }
}
