<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    public function state(){
      return $this->belongsTo('App\state');
    }
}
