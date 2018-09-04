<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_note extends Model
{
    public function note(){
      return $this->belongsTo('App\note');
    }
}
