<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoMenu extends Model
{
  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }
  public function menu(){
    return $this->belongsTo('App\Menu');
  }
}
