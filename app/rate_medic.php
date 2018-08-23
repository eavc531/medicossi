<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rate_medic extends Model
{
    protected $fillable = [
        'question1',
        'answer1',
        'question2',
        'answer2',
        'question3',
        'answer3',
        'question4',
        'answer4',
        'question5',
        'answer5',
        'answer6',
        'answer7',
        'rate',
        'votes',
        'show',
        'medico_id',
        'patient_id',

        ];

          public function patient(){
             return $this->belongsTo('App\patient');
          }

}
