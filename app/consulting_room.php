<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class consulting_room extends Model
{
  protected $fillable = [
    "type",
    "name",
    "addres",
    "colony",
    "numberExt",
    "numberInt",
    "city",
    "state",
    "passwordUnique",
    "medico_id"
  ];


}
