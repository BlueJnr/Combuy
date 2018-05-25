<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table="producto";
  protected $fillable=['Nom_producto ','TipoProd_idTipoProd ','Marca_idProducto_caract'];
  protected $primaryKey="idProducto";

  public function productolocal(){
    return $this->hasMany('App\ProductoLocal');
  }
  public function caracteristica(){
    return $this->belongsTo('App\Caracteristica');
  }
  public function marca(){
    return $this->belongsTo('App\Marca');
  }
  public function tipoprod(){
    return $this->belongsTo('App\TipoProd');
  }
}
