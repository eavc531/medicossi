<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expedient_note extends Model
{
  public function expedient(){
    return $this->belongsTo('App\expedient');
  }

  public function note(){
    return $this->belongsTo('App\note');
  }
}
