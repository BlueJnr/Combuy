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
            $table->string('latitud');
            $table->string('longitud');
            $table->string('descripcion',80);
            $table->string('telefono',9);
            $table->string('hora_inicio',5);
            $table->string('hora_fin',5);
            
            $table->integer('idempresa')->unsigned();
            
            $table->foreign('idempresa')->references('id')->on('empresa');
            
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
