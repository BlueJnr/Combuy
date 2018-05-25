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
        Schema::create('ProductoLocal', function (Blueprint $table) {
            $table->increments('idProductoLocal');
            $table->string('precio');

            $table->integer('LocalNegocio_idNegocio')->unsigned();
            $table->integer('Producto_idProducto')->unsigned();

            $table->foreign('LocalNegocio_idNegocio')->references('idNegocio')->on('LocalNegocio');
            $table->foreign('Producto_idProducto')->references('idProducto')->on('Producto');

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
        Schema::dropIfExists('ProductoLocal');
    }
}
