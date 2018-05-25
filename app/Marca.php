<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
  protected $table="marca";
  protected $fillable=['nombre_Marca'];
  protected $primaryKey="idProducto_Caract";
  public function producto(){
    return $this->hasMany('App\Producto');
  }
}
