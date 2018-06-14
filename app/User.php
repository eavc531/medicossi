<?php

namespace App;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\user as Authenticatable;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// class User extends Authenticatable
// {
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;
    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function administrator(){
       return $this->belongsTo('App\administrator');
    }

    public function medico(){
       return $this->belongsTo('App\medico');
    }

    public function medicalCenter(){
       return $this->belongsTo('App\medicalCenter');
    }

    public function promoter(){
       return $this->belongsTo('App\promoter');
    }

    public function patient(){
       return $this->belongsTo('App\patient');
    }



}
