<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicalCenter extends Model
{
   protected $fillable = [

     'id_medicalCenter',
     'name',
     'activePlan',
     'emailAdmin',
     'nameAdmin',
     'phone_admin',
     'phone',
     'phone2',
     'city',
     'billingData',
     'meansOfRecords',
     'confirmation_code',
     'statuss',
     'id_promoter',
     'plan',
     'activationPlan',
     'role',
     'password',
     'country',
     'email_institution',
     'sanitary_license',
     'state',
     'postal_code',
     'colony',
     'street',
     'number_ext',
     'number_int',
   ];

   public function scopeSearchMedical($query, $search){
     return $query->where('name','LIKE','%'.$search.'%');
  }
}
