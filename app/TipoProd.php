<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProd extends Model
{
  protected $table="tipoprod";
  protected $fillable=['NombreProducto'];
  protected $primaryKey="idTipoProd";
  public function producto(){
    return $this->hasMany('App\Producto');
  }
}
