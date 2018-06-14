<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class promoter extends Model
{

  protected $fillable = [
      'id_promoter', 'name', 'lastName','email'
      ];
      
}
