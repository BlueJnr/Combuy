<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
  protected $table="tiposervicio";
  protected $fillable=['nombretiposervicio'];
  protected $primaryKey="id";
  public $timestamps=false;
  public function serviciolocal(){
    return $this->hasMany('App\ServicioLocal');
  }
}
