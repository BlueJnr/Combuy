<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidadProfesionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidadprofesional', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia',2);
            $table->string('horainicio',2);
            $table->string('horafin',2);

            $table->integer('idlocalnegocio')->unsigned();
            $table->integer('idprofesionales')->unsigned();

            $table->foreign('idlocalnegocio')->references('id')->on('localnegocio');
            $table->foreign('idprofesionales')->references('id')->on('profesionales');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DisponibilidadProfesional');
    }
}
