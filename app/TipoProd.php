<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProd extends Model
{
  protected $table="tipoproducto";
  protected $fillable=['nomtipo'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function producto(){
    return $this->hasMany('App\Producto');
  }
}
