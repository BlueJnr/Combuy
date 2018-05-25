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
        Schema::create('DisponibilidadProfesional', function (Blueprint $table) {
            $table->increments('idDisponibilidadProfesional');
            $table->string('precio');

            $table->integer('LocalNegocio_idNegocio')->unsigned();
            $table->integer('Profesionales_idProfesionales')->unsigned();
            $table->integer('Dia_idDia')->unsigned();

            $table->foreign('LocalNegocio_idNegocio')->references('idNegocio')->on('LocalNegocio');
            $table->foreign('Profesionales_idProfesionales')->references('idProfesionales')->on('Profesionales');
            $table->foreign('Dia_idDia')->references('idDia')->on('Dia');


            $table->timestamps();
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
