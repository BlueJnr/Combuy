<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LocalNegocio', function (Blueprint $table) {
            $table->increments('idNegocio');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('descripcion');
            $table->string('telefono');
            $table->string('Hora_inicio');
            $table->string('Hora_fin');
            //FALTAN DOS CAMPOS
            $table->integer('Empresa_idEmpresa')->unsigned();
            $table->integer('TipoNegocio_idTipoNegocio')->unsigned();

            $table->foreign('Empresa_idEmpresa')->references('idEmpresa')->on('Empresa');
            $table->foreign('TipoNegocio_idTipoNegocio')->references('idTipoNegocio')->on('TipoNegocio');

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
        Schema::dropIfExists('LocalNegocio');
    }
}
