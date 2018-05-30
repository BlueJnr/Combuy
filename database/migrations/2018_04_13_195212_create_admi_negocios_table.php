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
        Schema::create('admnegocio', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idlocalnegocio')->unsigned();
            $table->integer('idusuario')->unsigned();

            $table->foreign('idlocalnegocio')->references('id')->on('localnegocio');
            $table->foreign('idusuario')->references('id')->on('users');
            
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
