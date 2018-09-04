<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
    protected $fillable = [
      'identification',
      'name',
      'lastName',
      'nameComplete',
      'gender',
      'email',
      'password',
      'city_id',
      'state_id',
      'medicalCenter_id',
      'phone',
      'facebook',
      'id_promoter',
      'stateConfirm',
      'showNumber',
      'showNumberOffice',
      'phoneOffice1',
       'phoneOffice2',
       'specialty',
       'sub_specialty',
       'country',
       'name_comercial'
    ];


    public function event(){
      return $this->belongsTo('App\event')->orderBy('id','desc');
   }

    public function history(){
      return $this->hasMany('App\history')->orderBy('id','desc');
   }

    public function rate_medic(){
      return $this->hasOne('App\rate_medic');
   }

    public function promoter(){
      return $this->belongsTo('App\promoter');

   }

    public function records_of_plans_medico(){
       return $this->hasMany('App\records_of_plans_medico');
    }

    public function plan_active(){
       return $this->hasOne('App\plan_active');
    }

    public function medico_specialty(){
       return $this->hasMany('App\medico_specialty');
    }

    public function scopeSearchMedico($query, $search){
      return $query->where('name','LIKE','%'.$search.'%')->orWhere('lastName','%'.$search.'%');
   }

     public function user(){
       return $this->hasOne('App\user');

    }

}
