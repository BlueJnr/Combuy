<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table="menu";
  protected $fillable=['plato','precio','disponible','idlocalnegocio'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function pedidomenu(){
    return $this->hasMany('App\PedidoMenu');
  }
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
}
