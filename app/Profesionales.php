<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesionales extends Model
{
  protected $table="profesionales";
  protected $fillable=['nomprofesional'];
  protected $primaryKey="id";

  public function disponibilidadprofesional(){
    return $this->hasMany('App\DisponibilidadProfesional');
  }
}
