<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodnegocio extends Model
{
    protected $table="prodnegocios";
    protected $fillable=['idlocalnegocio','idproductolocal','precio','stock'];
    protected $primaryKey="id";
    public $timestamps=false;
}
