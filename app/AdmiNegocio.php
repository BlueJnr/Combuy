<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmiNegocio extends Model
{
  //protected $table="adminegocio";
  protected $table="admnegocio";
  protected $fillable=['idNegocio','Usuario_idUsuario'];
  protected $primaryKey="idAdmNegocio";

  public function user(){
    return $this->belongsTo('App\Usuario');
  }
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
}
