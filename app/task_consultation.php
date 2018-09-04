<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task_consultation extends Model
{
    public function note(){
      return $this->belongsTo('App\note');
   }

   public function file(){
     return $this->belongsTo('App\file');
  }

  public function expedient(){
    return $this->belongsTo('App\expedient');
 }
}
