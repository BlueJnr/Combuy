<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioLocal extends Model
{
  protected $table="serviciolocal";
  protected $fillable=['precio','idlocalnegocio','idtiposervicio'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function localnegocio(){
    return $this->belongsTo('App\LocalNegocio');
  }
  public function tiposervicio(){
    return $this->belongsTo('App\TipoServicio');
  }
}
