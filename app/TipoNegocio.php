<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNegocio extends Model
{
  protected $table="tiponegocio";
  protected $fillable=['nombre'];
  protected $primaryKey="idTipoNegocio";
  
  public function localnegocio(){
    return $this->hasMany('App\LocalNegocio');
  }
}
