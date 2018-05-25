<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisponibilidadProfesional extends Model
{
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
  public function dia(){
    return $this->belongsTo('App\Dia');
  }
  public function profesionales(){
    return $this->belongsTo('App\Profesionales');
  }
}
