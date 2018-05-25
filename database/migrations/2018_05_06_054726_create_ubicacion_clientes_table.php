<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UbicacionCliente', function (Blueprint $table) {
            $table->increments('idUbicacionCliente');
            $table->string('NomIdentificador');
            $table->string('latitudCliente');
            $table->string('longitudCliente');
            $table->integer('Cliente_idCliente')->unsigned();


            $table->foreign('Cliente_idCliente')->references('idCliente')->on('Cliente');

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
        Schema::dropIfExists('UbicacionCliente');
    }
}
