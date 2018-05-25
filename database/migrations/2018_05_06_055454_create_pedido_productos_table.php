<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PedidoProducto', function (Blueprint $table) {
            $table->increments('idVentaHistorial');
            $table->string('cantidad');

            $table->integer('Cliente_idCliente')->unsigned();
            $table->integer('ProductoLocal_idProductoLocal')->unsigned();

            $table->foreign('Cliente_idCliente')->references('idCliente')->on('Cliente');
            $table->foreign('ProductoLocal_idProductoLocal')->references('idProductoLocal')->on('ProductoLocal');

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
        Schema::dropIfExists('PedidoProducto');
    }
}
