<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipolocalproducto extends Model
{
    protected $table="tipolocalproducto";
    protected $fillable=['nombre'];
    protected $primaryKey="id";
    public $timestamps=false;
}

