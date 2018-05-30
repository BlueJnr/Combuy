<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmiNegocio extends Model
{
  //protected $table="adminegocio";
  protected $table="admnegocio";
  protected $fillable=['idlocalnegocio','idusuario'];
  protected $primaryKey="id";
  public $timestamps=false;

  public function user(){
    return $this->belongsTo('App\Usuario');
  }
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
}
