<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PedidoMenu', function (Blueprint $table) {

            $table->increments('idVentaHistorial');
            $table->integer('cantidad');

            $table->integer('Cliente_idCliente')->unsigned();
            $table->integer('Menu_idMenu')->unsigned();


            $table->foreign('Cliente_idCliente')->references('idCliente')->on('Cliente');
            $table->foreign('Menu_idMenu')->references('idMenu')->on('Menu');

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
        Schema::dropIfExists('PedidoMenu');
    }
}
