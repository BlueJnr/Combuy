<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServicioLocal', function (Blueprint $table) {
            $table->increments('idServicio');
            $table->string('precio');

            $table->integer('idNegocio')->unsigned();
            $table->integer('TipoServicio_idTipoServicio')->unsigned();


            $table->foreign('idNegocio')->references('idNegocio')->on('LocalNegocio');
            $table->foreign('TipoServicio_idTipoServicio')->references('idTipoServicio')->on('TipoServicio');

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
        Schema::dropIfExists('ServicioLocal');
    }
}
