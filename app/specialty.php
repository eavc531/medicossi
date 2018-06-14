<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class specialty extends Model
{
  protected $fillable = [
      'name', 'description','synonymous1','synonymous2','synonymous3','specialty_category_id',
  ];

  public function specialty_category(){
     return $this->belongsTo('App\specialty_category');
  }
}
