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
        Schema::create('serviciolocal', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio',3,2);

            $table->integer('idlocalnegocio')->unsigned();
            $table->integer('idtiposervicio')->unsigned();


            $table->foreign('idlocalnegocio')->references('id')->on('localnegocio');
            $table->foreign('idtiposervicio')->references('id')->on('tiposervicio');

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
