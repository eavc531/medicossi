<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medico_specialty extends Model
{
  protected $fillable = [
    'type',
    'institution',
    'specialty',
    'from',
    'until',
    'aditional',
    'medico_id',
  ];

  public function medico(){
    return $this->belongsTo('App\medico');
}
}
