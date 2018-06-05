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
            
            $table->integer('idtipolocalproducto')->unsigned();
            $table->integer('idtipoproducto')->unsigned();

            $table->foreign('idtipolocalproducto')->references('id')->on('tipolocalproducto');
            $table->foreign('idtipoproducto')->references('id')->on('tipoproducto');

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
