<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Localnegocios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localnegocio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombrenegocio',40);
            $table->string('ruc',10);
            $table->string('latitud');
            $table->string('longitud');
            $table->string('descripcion',80);
            $table->string('telefono',9);
            $table->string('hora_inicio',5);
            $table->string('hora_fin',5);
            
            $table->integer('idtiponegocio')->unsigned();
            $table->foreign('idtiponegocio')->references('id')->on('tiponegocio');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
