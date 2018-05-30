<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productolocal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomproducto',40);
            $table->string('descripcion',200);
            $table->string('tiponegocio',40);
            
            $table->integer('idtipoproducto')->unsigned();
            $table->integer('idmarca')->unsigned();

            $table->foreign('idtipoproducto')->references('id')->on('tipoproducto');
            $table->foreign('idmarca')->references('id')->on('marca');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductoLocal');
    }
}
