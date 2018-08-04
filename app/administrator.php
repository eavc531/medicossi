<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class administrator extends Model
{
    protected $fillable = [
      'name',
      'lastName',
      'email',
      'permission_id',
      'city_id',

    ];

    public function permission(){
       return $this->belongsTo('App\permissions_admin');
    }
}
