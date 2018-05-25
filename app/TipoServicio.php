<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
  public function serviciolocal(){
    return $this->hasMany('App\ServicioLocal');
  }
}
