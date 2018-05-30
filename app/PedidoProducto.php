<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
  protected $table="pedidoproducto";
  protected $fillable=['cantidad','idcliente','idproductolocal'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }
  public function productolocal(){
    return $this->belongsTo('App\ProductoLocal');
  }
}
