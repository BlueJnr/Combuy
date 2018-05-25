<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  public function pedidomenu(){
    return $this->hasMany('App\PedidoMenu');
  }
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
}
