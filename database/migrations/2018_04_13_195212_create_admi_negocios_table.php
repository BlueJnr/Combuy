<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmiNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AdmNegocio', function (Blueprint $table) {
            $table->increments('idAdmNegocio');

            $table->integer('idNegocio')->unsigned();
            $table->integer('Usuario_idUsuario')->unsigned();

            $table->foreign('idNegocio')->references('idNegocio')->on('LocalNegocio');
            $table->foreign('Usuario_idUsuario')->references('idUsuario')->on('users');

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
        Schema::dropIfExists('AdmNegocio');
    }
}
