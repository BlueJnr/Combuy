<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLocal extends Model
{
    protected $table="tipolocal";
    protected $fillable=['idlocalnegocio','idlocalnegocio'];
    protected $primaryKey="id";
    public $timestamps=false;
}
