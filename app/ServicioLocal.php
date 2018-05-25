<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioLocal extends Model
{
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
  public function tiposervicio(){
    return $this->belongsTo('App\TipoServicio');
  }
}
