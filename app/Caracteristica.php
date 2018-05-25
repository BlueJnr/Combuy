<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
  protected $table="caracteristicas";
  protected $fillable=['caracteristica'];
  protected $primaryKey="idCarProd";
  public function producto(){
    return $this->hasMany('App\Producto');
  }
}
