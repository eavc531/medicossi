<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class records_of_plans_medico extends Model
{
    public function medico(){
       return $this->belongsTo('App\medico');
    }
}
