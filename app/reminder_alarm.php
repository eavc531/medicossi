<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reminder_alarm extends Model
{
  protected $fillable = [
    'title',
    'type',
    'description',
    'start',
    'end',
    'hour_start',
    'hour_end',
    'state',
    'eventType',
    'dow',
    'rendering',
    'color',
    'medico_id',



  ];

}
