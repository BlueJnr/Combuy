<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table="empresa";
  protected $fillable=['nombreempresa','ruc','telefono'];
  protected $primaryKey="id";
  public $timestamps=false;
  
  public function localnegocio(){
    return $this->hasMany('App\LocalNegocio');
  }
}
