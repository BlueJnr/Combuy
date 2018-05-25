<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
  public function disponibilidadprofesional(){
    return $this->hasMany('App\DisponibilidadProfesional');
  }
}
