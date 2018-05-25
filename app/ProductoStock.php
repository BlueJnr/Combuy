<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoStock extends Model
{
  public function productolocal(){
    return $this->belongsTo('App\ProductoLocal');
  }
}
