<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionCliente extends Model
{
  public function cliente(){
    return $this->hasMany('App\Cliente');
  }
}
