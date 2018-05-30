<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisponibilidadProfesional extends Model
{
  protected $table="disponibilidadprofesional";
  protected $fillable=['dia','horainicio','horafin','idlocalnegocio','idprofesionales'];
  protected $primaryKey="id";
  public $timestamps=false;
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
