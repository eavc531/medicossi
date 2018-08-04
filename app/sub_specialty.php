<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_specialty extends Model
{
  protected $fillable = [
      'name', 'description','synonymous1','synonymous2','synonymous3','specialty_id',
  ];

  public function specialty(){
     return $this->belongsTo('App\specialty');
  }
}
