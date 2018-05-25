<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalNegocio extends Model
{
    protected $table="localnegocio";
    protected $fillable=['latitud','longitud','descripcion','telefono ','Hora_inicio','Hora_fin','Empresa_idEmpresa','TipoNegocio_idTipoNegocio'];
    protected $primaryKey="idNegocio";
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
