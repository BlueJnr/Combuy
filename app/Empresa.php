<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table="empresa";
  protected $primaryKey="idEmpresa";
  protected $fillable=['name','ruc','telefono'];

  public function localnegocio(){
    return $this->hasMany('App\LocalNegocio');
  }
}
