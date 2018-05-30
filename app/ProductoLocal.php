<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoLocal extends Model
{
  protected $table="productolocal";
  protected $fillable=['nomproducto','descripcion','idlocalnegocio','idtipoproducto','idmarca'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function pedidoproducto(){
    return $this->hasMany('App\PedidoProducto');
  }
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
  public function productostock(){
    return $this->hasMany('App\ProductoStock');
  }
  public function producto(){
    return $this->belongsTo('App\Producto');
  }
}
