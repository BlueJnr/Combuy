<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
  protected $table="marca";
  protected $fillable=['nommarca'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function producto(){
    return $this->hasMany('App\Producto');
  }
}
