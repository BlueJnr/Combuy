<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sugerencias extends Model
{
    protected $table="sugerencias";
    protected $fillable=['nomproducto','descripcion','idtipolocalproducto','idtipoproducto'];
    protected $primaryKey="id";
    public $timestamps=false;
}
