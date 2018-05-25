<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  public function user(){
    return $this->belongsTo('App\User');
  }
  public function ubicacioncliente(){
    return $this->belongsTo('App\UbicacionCliente');
  }
  public function pedidomenu(){
    return $this->hasMany('App\PedidoMenu');
  }
  public function pedidoproducto(){
    return $this->hasMany('App\PedidoMenu');
  }
}
