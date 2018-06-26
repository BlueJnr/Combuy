<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalNegocio extends Model
{
    protected $table="localnegocio";
    protected $fillable=['nombrenegocio','ruc','latitud','longitud','direccion','descripcion','telefono','hora_inicio','hora_fin','idtiponegocio'];
    protected $primaryKey="id";
    public $timestamps=false;

    public function adminegocio(){
      return $this->hasOne('App\AdmiNegocio');
    }
    public function empresa(){
      return $this->belongsTo('App\Empresa');
    }
    public function tiponegocio(){
      return $this->belongsTo('App\TipoNegocio');
    }
    /*
    public function menu(){
      return $this->hasMany('App\Menu');
    }
    public function productolocal(){
      return $this->hasMany('App\ProductoLocal');
    }
    public function disponibilidadprofesional(){
      return $this->hasMany('App\DisponibilidadProfesional');
    }
    public function serviciolocal(){
      return $this->hasMany('App\ServicioLocal');
    }*/
}
