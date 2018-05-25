<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }
  public function productolocal(){
    return $this->belongsTo('App\ProductoLocal');
  }
}
