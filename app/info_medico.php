<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class info_medico extends Model
{
  protected $fillable = [
    'type',
    'institution',
    'specialty',
    'state',
    'from',
    'until',
    'aditional',
    'medico_id',
  ];


}
