<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   //protected $table=" users";
    protected $fillable=['name','lastname','dni','username', 'password','email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function adminegocio(){
      return $this->hasOne('App\AdmiNegocio');
    }
   /* public function cliente(){
        return $this->hasOne('App\Cliente');
      }*/
}
