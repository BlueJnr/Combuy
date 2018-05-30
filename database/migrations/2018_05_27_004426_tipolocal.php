<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tipolocal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipolocal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idtiponegocio')->unsigned();
            $table->integer('idlocalnegocio')->unsigned();

            $table->foreign('idtiponegocio')->references('id')->on('tiponegocio');
            $table->foreign('idlocalnegocio')->references('id')->on('localnegocio');
            
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
