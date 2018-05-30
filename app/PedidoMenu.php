<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoMenu extends Model
{
  protected $table="pedidomenu";
  protected $fillable=['cantidad','idcliente','idmenu'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function cliente(){
    return $this->belongsTo('App\Cliente');
  }
  public function menu(){
    return $this->belongsTo('App\Menu');
  }
}
